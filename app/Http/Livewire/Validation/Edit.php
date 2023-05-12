<?php

namespace App\Http\Livewire\Validation;

use Livewire\Component;
use App\Models\Validation;
use App\Models\QuestionnairePage;
use App\Models\Question;

class Edit extends Component
{

    public $modalEdit = false;
    public $questions;
    public $questionnaire_pages;
    public Validation $answer;
    protected $listeners = ['modalEdit'];
    protected $rules = [
        'answer.order' => 'required|numeric|min:1',
        'answer.question_id' => 'required|numeric|min:1',
        'answer.points' => 'numeric',
        'answer.text' => 'required|string|min:6',
        'answer.subtext' => 'string|max:500',
    ];

    public function mount() {
        $this->questionnaire_pages = QuestionnairePage::where('questionnaire_id', auth()->user()->getCurrentQuestionnaire())->get();
        $this->questions = Question::whereIn('questionnaire_page_id', $this->questionnaire_pages->pluck('id')->toArray())->get();
    }

    public function render()
    {
        return view('livewire.answer.edit');
    }

    public function modalEdit() {
        $this->modalEdit = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editValidation() {
        $this->validate();

        $this->answer->save();

        $this->emit('answerEdited');
        $this->modalEdit = false;
    }

}
