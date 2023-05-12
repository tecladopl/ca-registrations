<?php

namespace App\Http\Livewire\Assembly;

use Livewire\Component;
use App\Models\Assembly;

class Edit extends Component
{

    public $modalEdit = false;
    public Assembly $assembly;
    protected $listeners = ['modalEdit'];
    protected $rules = [
        'assembly.name' => 'required|string|min:4',
        'assembly.description' => 'required|string|max:500',
    ];

    public function mount() {

    }

    public function render()
    {
        return view('livewire.assembly.edit');
    }

    public function modalEdit() {
        $this->modalEdit = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editAssembly() {
        $this->validate();

        $this->assembly->save();

        $this->emit('assemblyEdited');
        $this->modalEdit = false;
    }

}
