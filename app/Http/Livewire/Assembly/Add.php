<?php

namespace App\Http\Livewire\Assembly;

use Livewire\Component;
use App\Http\Controllers\AssemblyController;
use App\Models\Assembly;

class Add extends Component {

    public $modal = false;
    public $name;
    public $description;
    protected $listeners = ['modal'];
    protected $rules = [
        'name' => 'required|string|min:6',
        'description' => 'required|string|max:500',
    ];

    public function mount() {

    }

    public function modal() {
        $this->modal = true;
    }

    public function render() {
        return view('livewire.assembly.add');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addAssembly() {

        $validatedData = $this->validate();

        $assembly = Assembly::create($validatedData);

        $assemblies = Assembly::all();
        if($assemblies->count()===1){
            $user = auth()->user();
            $user->setCurrentAssembly($assembly->id);
        }

        $this->emit('assemblyAdded');
        $this->modal = false;
        $this->name = null;
        $this->description = null;
    }

}
