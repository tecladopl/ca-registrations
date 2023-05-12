<?php

namespace App\Http\Livewire\Validation;

use App\Http\Livewire\Validation;
use App\Models\QuestionnairePage;
use Livewire\Component;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{

    public $answers;
    protected $listeners = [
        'ValidationAdded' => '$refresh',
        'ValidationEdited' => '$refresh',
        'ValidationDeleted' => '$refresh',
        'ValidationActivated' => '$refresh',
    ];
    public $current_questionnaire_id;
    public $questionnaire_pages;
    public $questions;
    public $validations;


    public function mount()
    {

    }

    public function render()
    {
        $this->current_questionnaire_id = auth()->user()->current_questionnaire_id;
        $questionnaire_pages = QuestionnairePage::where('questionnaire_id', $this->current_questionnaire_id)->get();
        $this->questionnaire_pages = $questionnaire_pages;
        $questions = Question::whereIn('questionnaire_page_id', $questionnaire_pages->pluck('id')->toArray())->with('questionnaire_page')->with('question_type')->get();
        $this->questions = $questions;
        $this->current_questionnaire_id = auth()->user()->current_questionnaire_id;
        $this->answers = Answer::whereIn('question_id', $questions->pluck('id')->toArray())->get();
        //$this->validations = \App\Models\Validation::whereHas('answers')->orWhereHas('questions')->with('answers')->with('questions')->get();

        $this->validations = \App\Models\Validation::with('answers')
            ->with('questions')
            ->whereHas('answers', function (Builder $query) {
                $query->whereIn('answers.id', $this->answers->pluck('id')->toArray());
            })
            ->orWhereHas('questions', function (Builder $query) {
                $query->whereIn('questions.id', $this->questions->pluck('id')->toArray());
            })
            ->get();

        return view('livewire.validation.index');
    }


}
