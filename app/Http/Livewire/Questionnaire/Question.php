<?php

namespace App\Http\Livewire\Questionnaire;

use Livewire\Component;

class Question extends Component
{

    public $question;
    public $applicant;
    public $answers;

    public function render()
    {
        return view('livewire.questionnaire.question');
    }

}
