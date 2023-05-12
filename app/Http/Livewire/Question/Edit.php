<?php

namespace App\Http\Livewire\Question;

use Dirape\Token\Token;
use Livewire\Component;
use App\Models\Question;
use App\Models\QuestionnairePage;

class Edit extends Component
{

    public $modalEdit = false;
    public Question $question;
    protected $listeners = ['modalEdit'];
    protected $rules = [
        'question.questionnaire_page_id' => 'required|numeric|min:1',
        'question.name' => 'required|string|min:3',
        'question.subtext' => 'required|string|max:500',
        'question.question_type_id' => 'required',
        'question.order' => 'required|numeric|min:1',
    ];
    public $questionnaire_pages;
    public $question_type_id;


    public function mount() {
        $this->questionnaire_pages = QuestionnairePage::where('questionnaire_id', auth()->user()->getCurrentQuestionnaire())->get();
    }

    public function render()
    {
        return view('livewire.question.edit');
    }

    public function modalEdit() {
        $this->modalEdit = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editQuestion() {
        $this->validate();
        $this->question->question =  $this->question->name;

        $this->question->save();

        $this->emit('questionEdited');
        $this->modalEdit = false;
    }

}
