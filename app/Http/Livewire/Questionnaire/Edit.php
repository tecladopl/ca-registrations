<?php

namespace App\Http\Livewire\Questionnaire;

use Livewire\Component;
use App\Models\Questionnaire;

class Edit extends Component
{

    public $modalEdit = false;
    public Questionnaire $questionnaire;
    protected $listeners = ['modalEdit'];
    protected $rules = [
        'questionnaire.name' => 'required|string|min:6',
        'questionnaire.path' => 'required|string|min:6',
        'questionnaire.description' => 'sometimes|string|max:500',
        'questionnaire.start' => 'required|date_format:Y-m-d H:i:s',
        'questionnaire.end' => 'required|date_format:Y-m-d H:i:s',
    ];

    public function mount() {

    }

    public function render()
    {
        return view('livewire.questionnaire.edit');
    }

    public function modalEdit() {
        $this->modalEdit = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editQuestionnaire() {
        $this->validate();

        $this->questionnaire->save();

        $this->emit('questionnaireEdited');
        $this->modalEdit = false;
    }

}
