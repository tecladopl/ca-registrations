<?php

namespace App\Http\Livewire\Validation;

use Livewire\Validation;
use Livewire\Component;

class Delete extends Component
{

    public $modalDelete = false;
    public \App\Models\Validation $validation;
    protected $listeners = ['modalDelete'];

    public function render()
    {
        return view('livewire.validation.delete');
    }

    public function modalDelete() {
        $this->modalDelete = true;
    }

    public function deleteValidation() {
        $this->validation->delete();
        $this->emit('ValidationDeleted');
        $this->modalDelete = false;
    }
}
