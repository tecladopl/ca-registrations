<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DataProcessing extends Component
{

    public $assembly;
    public $declaration_of_data_compliance_with_the_truth;
    public $consent_to_the_processing_of_personal_data;

    protected $listeners = ['lastSubmit'];

    protected $rules = [
        'declaration_of_data_compliance_with_the_truth' => 'required',
        'consent_to_the_processing_of_personal_data' => 'required',
        
    ];



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.data-processing');
    }

    public function lastSubmit()
    {
        $this->validate();
    }
}
