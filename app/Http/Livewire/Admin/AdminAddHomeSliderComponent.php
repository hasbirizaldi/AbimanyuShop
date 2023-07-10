<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    
    public $top_title,
            $title,
            $sub_title,
            $offer,
            $status,
            $link,
            $image;

    public function addSlide(){

        $this->validate([

            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'status' => 'required',
            'link' => 'required',
            'image' => 'required',
        ]);

        $slide = new HomeSlider();

        $slide->top_title = $this->top_title;
        $slide->title = $this->title;
        $slide->sub_title = $this->sub_title;
        $slide->offer = $this->offer;
        $slide->link = $this->link;
        $slide->status = $this->status;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('slider', $imageName);
        $slide->image = $imageName;

        $slide->save();
        return redirect()->route('admin.home.slider')->with('message', 'Slider has been added');

    }
    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component');
    }
}