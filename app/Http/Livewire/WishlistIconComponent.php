<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WishlistIconComponent extends Component
{
    protected $listener = ['refreshComponent'=>'$request'];

    public function render()
    {
        return view('livewire.wishlist-icon-component');
    }
}