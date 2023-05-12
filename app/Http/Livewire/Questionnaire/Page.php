<?php

namespace App\Http\Livewire\Questionnaire;

use Livewire\Component;

class Page extends Component
{
    public $page;
    public $pages;
    public $questions;
    public $applicant;
    public $answers;
    public $questionnaire;

    public function render()
    {
        return view('livewire.questionnaire.page');
    }
}
