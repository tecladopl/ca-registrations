<?php

namespace App\Http\Livewire\Assembly\Criteria;

use App\Models\Category;
use App\Models\CategoryType;
use Livewire\Component;

class Add extends Component
{

    public $modal = false;
    public $category_types;
    public $name;
    public $priority = 1;
    public $category_type_id;
    public $current_assembly_id;
    protected $listeners = ['modal'];
    protected $rules = [
        'name' => 'required|string|min:2',
        'priority' => 'required|integer|min:1',
        'category_type_id' => 'required',
    ];

    public function mount() {

    }

    public function render()
    {
        $this->category_types = CategoryType::all();
        return view('livewire.assembly.criteria.add');
    }

    public function modal() {
        $this->modal = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addCriterion() {

        $validatedData = $this->validate();


        $validatedData['assembly_id'] = $this->current_assembly_id = auth()->user()->getCurrentAssembly();
        Category::create($validatedData);

        $this->emit('criterionAdded');
        $this->modal = false;
        $this->name = null;
        $this->priority = 1;
        $this->category_type_id = null;
    }
}
