<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name,
             $slug, 
             $description, 
             $short_description, 
             $regular_price, 
             $sale_price, 
             $SKU,
             $stock_status='instock', 
             $featured=0, 
             $quantity, 
             $image, 
             $category_id;

    public function generateSlug(){

        $this->slug = Str::slug($this->name);
    }

    public function addProduct(){

        $this->validate([

            'name'=>'required',
            'slug'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'regular_price'=>'required',
            'sale_price'=>'required',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required',
            'image'=>'required|image|mimes:jpg,jpeg,png,svg, max:2048',
            'category_id'=>'required',
        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        $imageName = Carbon::now()->timestamp. '.'. $this->image->extension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;

        $product->category_id = $this->category_id;


        $product->save();
        // session()->flash('message', 'success');

        return redirect()->route('admin.product')->with('message', 'Product has been added');
    }

    public function render()
    {

        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.admin.admin-add-product-component', compact('categories'));
    }
}