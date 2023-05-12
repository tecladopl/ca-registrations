<?php

namespace App\Http\Livewire\Question;

use App\Models\QuestionnairePage;
use Livewire\Component;
use App\Models\Question;

class Index extends Component {

    public $questionnaire_pages;
    public $questions;
    protected $listeners = [
        'questionAdded' => '$refresh',
        'questionEdited' => '$refresh',
        'questionDeleted' => '$refresh',
        'questionActivated' => '$refresh',
    ];
    public $current_questionnaire_id;


    public function mount() {

    }

    public function render() {
        $this->current_questionnaire_id = auth()->user()->current_questionnaire_id;
        $questionnaire_pages = QuestionnairePage::where('questionnaire_id', $this->current_questionnaire_id)->get();
        $this->questionnaire_pages = $questionnaire_pages;
        $questions = Question::whereIn('questionnaire_page_id',$questionnaire_pages->pluck('id')->toArray())->with('questionnaire_page')->with('question_type')->get();
        $this->questions = $questions;
        return view('livewire.question.index');
    }



}
