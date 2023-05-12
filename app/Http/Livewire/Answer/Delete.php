<?php

namespace App\Http\Livewire\Answer;

use Livewire\Answer;
use Livewire\Component;

class Delete extends Component
{

    public $modalDelete = false;
    public \App\Models\Answer $answer;
    protected $listeners = ['modalDelete'];

    public function render()
    {
        return view('livewire.answer.delete');
    }

    public function modalDelete() {
        $this->modalDelete = true;
    }

    public function deleteAnswer() {
        $this->answer->delete();
        $this->emit('AnswerDeleted');
        $this->modalDelete = false;
    }
}
