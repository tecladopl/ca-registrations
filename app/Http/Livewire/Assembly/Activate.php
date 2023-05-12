<?php

namespace App\Http\Livewire\Assembly;

use App\Models\Assembly;
use Livewire\Component;

class Activate extends Component
{

    public Assembly $assembly;

    public function render()
    {
        return view('livewire.assembly.activate');
    }

    public function activate() {
        auth()->user()->setCurrentAssembly($this->assembly->id);
        $this->emit('assemblyActivated');
    }
}
