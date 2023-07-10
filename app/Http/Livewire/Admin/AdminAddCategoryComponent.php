<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminAddCategoryComponent extends Component
{
    use WithFileUploads;
    public $name, $slug, $image, $is_popular=0;

    public function generateSlug(){

        $this->slug = Str::slug($this->name);
    }

    public function updated($fluids){

        $this->validateOnly($fluids, [

            'name'=>'required',
            'slug'=>'required',
            'image'=>'required',
        ]);
    }

    public function storeCategory(){

        $this->validate([


            'name'=>'required',
            'slug'=>'required',
            'image'=>'required',

        ]);
        
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;

        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('categories', $imageName);
        $category->image = $imageName;

        $category->is_popular = $this->is_popular;
        $category->save();
        session()->flash('message', 'Category has been created successfully');
        return redirect()->route('admin.categories');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-category-component');
    }
}