<?php

namespace App\Http\Livewire\Answer;

use App\Models\QuestionnairePage;
use Livewire\Component;
use App\Models\Answer;
use App\Models\Question;

class Index extends Component {

    public $answers;
    protected $listeners = [
        'AnswerAdded' => '$refresh',
        'AnswerEdited' => '$refresh',
        'AnswerDeleted' => '$refresh',
        'AnswerActivated' => '$refresh',
        'predefinedAnswerAdded' => '$refresh',
    ];
    public $current_questionnaire_id;
    public $questionnaire_pages;
    public $questions;


    public function mount() {

    }

    public function render() {
        $this->current_questionnaire_id = auth()->user()->current_questionnaire_id;
        $questionnaire_pages = QuestionnairePage::where('questionnaire_id', $this->current_questionnaire_id)->get();
        $this->questionnaire_pages = $questionnaire_pages;
        $questions = Question::whereIn('questionnaire_page_id',$questionnaire_pages->pluck('id')->toArray())->with('questionnaire_page')->with('question_type')->get();
        $this->questions = $questions;
        $this->current_questionnaire_id = auth()->user()->current_questionnaire_id;
        $answers = Answer::whereIn('question_id', $questions->pluck('id')->toArray())->get();
        $this->answers = $answers;
        return view('livewire.answer.index');
    }



}
