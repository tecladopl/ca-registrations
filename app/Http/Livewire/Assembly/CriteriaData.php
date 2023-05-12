<?php

namespace App\Http\Livewire\Assembly;

use App\Models\Assembly;
use App\Models\Category;
use App\Models\CategoryValue;
use Livewire\Component;

class CriteriaData extends Component
{

    public $criteria;
    public $criteriaData;
    public $current_assembly_id;
    public Assembly $assembly;
    protected $listeners = [
        'criterionDataAdded' => '$refresh',
        'criterionDataEdited' => '$refresh',
        'criterionDataDeleted' => '$refresh',
    ];

    public function render()
    {
        $this->current_assembly_id = auth()->user()->getCurrentAssembly();
        if(!empty($this->current_assembly_id)){
            $this->assembly = Assembly::find($this->current_assembly_id);
        }

        $this->criteria = Category::where('assembly_id', $this->current_assembly_id)->with('category_type')->with('category_values')->get();
        return view('livewire.assembly.criteria-data');
    }
}
