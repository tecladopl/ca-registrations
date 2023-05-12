<?php

namespace App\Http\Livewire\Assembly\CriteriaData;

use App\Models\Assembly;
use App\Models\Category;
use App\Models\CategoryValue;
use Livewire\Component;

class Add extends Component
{

    public Category $criterion;
    public $modal = false;
    public $value;
    public $min;
    public $max;
    public $amount;
    public $category_id;
    protected $listeners = ['modal'];
    protected $rules = [
        'value' => 'sometimes|nullable|string|min:2',
        'min' => 'exclude_if:max,null|sometimes|nullable|numeric|lt:max',
        'max' => 'exclude_if:min,null|sometimes|nullable|numeric|gt:min',
        'amount' => 'required|integer|min:0',
    ];

    public function render()
    {
        return view('livewire.assembly.criteria-data.add');
    }

    public function mount()
    {
        $this->category_id = $this->criterion->id;
    }

    public function modal()
    {
        $this->modal = true;
    }

    public function updated()
    {
        $this->validate();
    }

    public function addCriterionData()
    {
        $validatedData = $this->validate();
        $validatedData['category_id'] = $this->category_id;

        CategoryValue::create($validatedData);

        $this->emit('criterionDataAdded');
        $this->modal = false;
        $this->value = null;
        $this->amount = null;
        $this->min = null;
        $this->max = null;
    }


}
