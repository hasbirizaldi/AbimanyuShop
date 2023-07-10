<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\HomeSlider;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeComponent extends Component
{

    public function store($product_id, $product_name, $product_price){
        Cart::instance('cart')->add($product_id, $product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Item Added in Cart');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('shop');
    }
    public function render()
    {
        $slides = HomeSlider::where('status', 1)->get();
        $lProducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $fProducts = Product::where('featured', 1)->inRandomOrder()->get()->take(8);
        $tCategories = Category::where('is_popular', 1)->inRandomOrder()->get()->take(8);
        return view('livewire.home-component', compact('slides', 'lProducts', 'fProducts', 'tCategories'));
    }
}