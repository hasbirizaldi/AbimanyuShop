<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    
    public $top_title,
            $title,
            $sub_title,
            $offer,
            $status,
            $link,
            $image,
            $slide_id,
            $newImage;

    public function mount($slide_id){
        
        $slide = HomeSlider::find($slide_id);

        $this->top_title = $slide->top_title;
        $this->title = $slide->title;
        $this->sub_title = $slide->sub_title;
        $this->offer = $slide->offer;
        $this->top_title = $slide->top_title;
        $this->link = $slide->link;
        $this->status = $slide->status;
        $this->image = $slide->image;
        // $this->slide_id = $slide->slide_id;
    }
    public function updateSlide(){

        $this->validate([

            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'status' => 'required',
            'link' => 'required',
        ]);

        $slide = HomeSlider::find($this->slide_id);

        $slide->top_title = $this->top_title;
        $slide->title = $this->title;
        $slide->sub_title = $this->sub_title;
        $slide->offer = $this->offer;
        $slide->link = $this->link;
        $slide->status = $this->status;

        if($this->newImage){

            unlink('assets/imgs/slider/'.$slide->image);
            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('slider', $imageName);
            $slide->image = $imageName;
        }

        $slide->save();
        return redirect()->route('admin.home.slider')->with('message', 'Slider has been updated');

    }
    public function render()
    {
        
        return view('livewire.admin.admin-edit-home-slider-component');
    }
}