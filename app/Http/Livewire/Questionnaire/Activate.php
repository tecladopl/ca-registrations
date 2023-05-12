<?php

namespace App\Http\Livewire\Questionnaire;

use App\Models\Questionnaire;
use Livewire\Component;

class Activate extends Component
{

    public Questionnaire $questionnaire;
    public function render()
    {
        return view('livewire.questionnaire.activate');
    }

    public function activate() {
        auth()->user()->setCurrentQuestionnaire($this->questionnaire->id);
        $this->emit('questionnaireActivated');
    }
}
