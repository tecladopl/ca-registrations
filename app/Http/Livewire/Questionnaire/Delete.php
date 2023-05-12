<?php

namespace App\Http\Livewire\Questionnaire;

use App\Models\Questionnaire;
use Livewire\Component;

class Delete extends Component
{

    public $modalDelete = false;
    public Questionnaire $questionnaire;
    protected $listeners = ['modalDelete'];

    public function render()
    {
        return view('livewire.questionnaire.delete');
    }

    public function modalDelete() {
        $this->modalDelete = true;
    }

    public function deleteQuestionnaire() {
        $this->questionnaire->delete();
        $this->emit('questionnaireDeleted');
        $this->modalDelete = false;
    }
}
