<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\State;

class TestComponent extends Component
{
    #[State]
    public string $name = '';

    public function render()
    {
        return view('livewire.test-component');
    }
}