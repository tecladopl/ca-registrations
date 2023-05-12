<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Phone extends Component
{

    

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.phone');
    }
}
