<?php

namespace App\Http\Livewire\Assembly\CriteriaData;

use App\Models\Category;
use App\Models\CategoryValue;
use Livewire\Component;

class Edit extends Component
{
    public $modalEdit = false;
    public CategoryValue $criterionData;
    public Category $criterion;
    protected $listeners = ['modalEdit'];
    protected $rules = [
        'criterionData.value' => 'sometimes|nullable|string|min:2',
        'criterionData.min' => 'sometimes|nullable|numeric|lt:max',
        'criterionData.max' => 'sometimes|nullable|numeric|gt:min',
        'criterionData.amount' => 'required|integer|min:0',
    ];

    public function render()
    {
        return view('livewire.assembly.criteria-data.edit');
    }

    public function modalEdit() {
        $this->modalEdit = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function EditCriterionData() {

        $this->validate();

        $this->criterionData->save();

        $this->emit('criterionDataEdited');
        $this->modalEdit = false;
    }
}
