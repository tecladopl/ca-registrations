<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationDropdownNew extends Component
{
    protected $listeners = [
        'refresh-navigation-dropdown' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.navigation-dropdown-new');
    }
}
