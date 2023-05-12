<?php

namespace App\Http\Livewire\Questionnaire;

use Livewire\Component;

class Page2 extends Component
{
    public $page;
    public $pages;
    public $path;
    public $questions;
    public $applicant;
    public $answers;
    public $answers2;

    public function render()
    {
        return view('livewire.questionnaire.page2');
    }
}
