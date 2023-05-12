<?php

namespace App\Http\Livewire\Assembly\Criteria;

use App\Models\Category;
use Livewire\Component;

class Delete extends Component
{

    public $modalDelete = false;
    public Category $criterion;
    protected $listeners = ['modalDelete'];

    public function render()
    {
        return view('livewire.assembly.criteria.delete');
    }

    public function modalDelete() {
        $this->modalDelete = true;
    }

    public function deleteCriterion() {
        $this->criterion->delete();
        $this->emit('criterionDeleted');
        $this->modalDelete = false;
    }
}
