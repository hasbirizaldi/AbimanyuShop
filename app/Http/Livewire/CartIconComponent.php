<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartIconComponent extends Component
{

    protected $listener = ['refreshComponent'=>'$request'];
    public function render()
    {
        return view('livewire.cart-icon-component');
    }
}