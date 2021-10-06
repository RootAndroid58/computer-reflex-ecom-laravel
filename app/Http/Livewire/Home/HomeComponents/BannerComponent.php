<?php

namespace App\Http\Livewire\Home\HomeComponents;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BannerComponent extends Component
{
    use WithFileUploads;
    
    public $component;
    public $dataKey="0";
    public $editUrl=false;
    public $url;
    public $editImage=false;
    public $image;

    public $x;
    public $y;
    public $width;
    public $height;

    public function mount()
    {
        $this->visibility = $this->component->visible;
        $this->url = $this->component->data[$this->dataKey]->link;
    }

    public function updatedImage()
    {
        $this->emit('cropperInit', [
            'imageUrl' => $this->image->temporaryUrl(),
            'aspectRatio' => bannerAspectRatio($this->component->type),
            'id' => $this->component->id,
            'dataKey' => $this->dataKey,
            'wireId' => $this->id,
        ]);
    }
    
    public function updatedDataKey()
    {
        $this->reset(['editImage', 'image', 'editUrl', 'url']);
        $this->url = $this->component->data[$this->dataKey]->link;
    }

    public function edit()
    {
        abort_unless(Auth::check() && Auth::user()->hasAnyPermission(['Manage UI', 'Master Admin']), '403', 'Unauthorized.');
        
        $this->validate();
       
        $data = $this->component->data;

        if ($this->editUrl) {
            if ($this->url == '') {
                $data[$this->dataKey]->link = null;
            } else {
                $data[$this->dataKey]->link = $this->url;
            }
        }
       

        if ($this->editImage) {

            $this->image->store('images/banner', 'public');

            $data[$this->dataKey]->image = $this->image->hashName(); // Add New Image Name To Array

            $this->x = intval($this->x);
            $this->y = intval($this->y);
            $this->width = intval($this->width);
            $this->height = intval($this->height);

            // Crop
            Image::make(public_path('storage/images/banner/'.$this->image->hashName()))
            ->crop($this->width, $this->height, $this->x, $this->y)
            ->save();
            
            if ($this->component->data[$this->dataKey]->image != 'image-8-5.png' && $this->component->data[$this->dataKey]->image != 'image-9-2.png') {
                Storage::delete('/public/images/banner/'.$this->component->data[$this->dataKey]->image);
            }
        }

        $this->component->update(['data' => serialize(json_decode(json_encode($data))), 'visible' => $this->visibility]);
        $this->emit('modal', [
            'el' => '#EditComponentModal-'.$this->component->id,
            'action' => 'hide',
        ]);
        $this->reset(['editImage', 'image', 'editUrl']);
    }

    public function rules()
    {
        return [
            'dataKey' => 'required|numeric',
            'image' => 'nullable|required_if:editImage,true|mimes:jpeg,jpg,png,gif,webp|max:10000',
            'url'   => 'nullable|url',
        ];
    }

    public function render()
    {
        return view('livewire.home.home-components.banner-component');
    }
}
