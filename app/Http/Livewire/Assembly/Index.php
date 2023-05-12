<?php

namespace App\Http\Livewire\Assembly;

use Livewire\Component;
use App\Models\Assembly;

class Index extends Component {

    public $assemblies;
    protected $listeners = [
        'assemblyAdded' => '$refresh',
        'assemblyEdited' => '$refresh',
        'assemblyDeleted' => '$refresh',
        'assemblyActivated' => '$refresh',
    ];
    public $current_assembly_id;


    public function mount() {

    }

    public function render() {
        $this->current_assembly_id = auth()->user()->current_assembly_id;
        $assemblies = Assembly::all();
        $this->assemblies = $assemblies;
        return view('livewire.assembly.index');
    }



}
