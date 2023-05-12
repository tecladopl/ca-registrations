<?php

namespace App\Http\Livewire\Assembly;

use App\Models\Assembly;
use Livewire\Component;

class Delete extends Component
{

    public $modalDelete = false;
    public Assembly $assembly;
    protected $listeners = ['modalDelete'];

    public function render()
    {
        return view('livewire.assembly.delete');
    }

    public function modalDelete() {
        $this->modalDelete = true;
    }

    public function deleteAssembly() {
        $this->assembly->delete();
        $this->emit('assemblyDeleted');
        $this->modalDelete = false;
    }
}
