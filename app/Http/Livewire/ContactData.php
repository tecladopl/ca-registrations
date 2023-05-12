<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactData extends Component
{

    public $assembly;
    public $phone;
    public $email;

    protected $listeners = ['lastSubmit'];

    protected $rules = [
        'phone' => 'required_without:email|nullable|min:9|numeric',
        'email' => 'required_without:phone|nullable|email',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.contact-data');
    }

    public function lastSubmit()
    {
        $this->validate();
    }
}
