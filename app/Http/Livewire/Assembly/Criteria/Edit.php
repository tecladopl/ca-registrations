<?php

namespace App\Http\Livewire\Assembly\Criteria;

use App\Models\Category;
use App\Models\CategoryType;
use Livewire\Component;

class Edit extends Component
{

    public $modalEdit = false;
    public $category_types;
    public Category $criterion;
    protected $listeners = ['modalEdit'];
    protected $rules = [
        'criterion.name' => 'required|string|min:2',
        'criterion.priority' => 'required|integer|min:1',
        'criterion.category_type_id' => 'required',
    ];

    public function render()
    {
        $this->category_types = CategoryType::all();
        return view('livewire.assembly.criteria.edit');
    }

    public function modalEdit() {
        $this->modalEdit = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function EditCriterion() {

        $this->validate();

        $this->criterion->save();

        $this->emit('criterionEdited');
        $this->modalEdit = false;
    }

}
