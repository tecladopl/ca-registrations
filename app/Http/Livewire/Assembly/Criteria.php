<?php

namespace App\Http\Livewire\Assembly;

use Livewire\Component;
use App\Models\Category;
use App\Models\Assembly;

class Criteria extends Component
{
    public $criteria;
    public $current_assembly_id;
    public Assembly $assembly;


    protected $listeners = [
        'criterionAdded' => '$refresh',
        'criterionEdited' => '$refresh',
        'criterionDeleted' => '$refresh'
    ];

    public function render()
    {
        $this->current_assembly_id = auth()->user()->getCurrentAssembly();
        if(!empty($this->current_assembly_id)) {
            $this->assembly = Assembly::find($this->current_assembly_id);
        }
        $this->criteria = Category::where('assembly_id', $this->current_assembly_id)->with('category_type')->get();
        return view('livewire.assembly.criteria');
    }
}
