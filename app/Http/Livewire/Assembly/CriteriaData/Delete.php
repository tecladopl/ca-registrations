<?php

namespace App\Http\Livewire\Assembly\CriteriaData;

use App\Models\Category;
use App\Models\CategoryValue;
use Livewire\Component;

class Delete extends Component
{

    public $modalDelete = false;
    public Category $criterion;
    public CategoryValue $criterionData;
    protected $listeners = ['modalDelete'];

    public function render()
    {
        return view('livewire.assembly.criteria-data.delete');
    }

    public function modalDelete() {
        $this->modalDelete = true;
    }

    public function deleteCriterionData() {
        $this->criterionData->delete();
        $this->emit('criterionDataDeleted');
        $this->modalDelete = false;
    }


}
