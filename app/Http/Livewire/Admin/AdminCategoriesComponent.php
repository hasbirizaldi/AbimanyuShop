<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use livewire\WithPagination;

class AdminCategoriesComponent extends Component
{
    public $category_id;
    
    use WithPagination;

    public function deleteCategory(){

        $category = Category::find($this->category_id);
        unlink('assets/imgs/categories/'.$category->newImage);

        $category->delete();
        return redirect()->route('admin.categories')->with('message', 'Category has been deleted');
    }
    
    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->paginate(9);
        return view('livewire.admin.admin-categories-component', compact('categories'));
    }
}