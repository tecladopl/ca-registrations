<?php

namespace Laravel\Jetstream\Http\Livewire;

use Livewire\Component;

class NavigationDropdown2 extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-dropdown' => '$refresh',
    ];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.navigation-dropdown2');
    }
}
