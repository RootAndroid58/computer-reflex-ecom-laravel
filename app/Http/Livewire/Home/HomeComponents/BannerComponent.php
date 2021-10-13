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

    public $editMarginTop=false;
    public $marginTop;
    public $marginTopUnit;
    public $editMarginBottom=false;
    public $marginBottom;
    public $marginBottomUnit;

    public $x;
    public $y;
    public $width;
    public $height;

    public function updated($field)
    {
        $this->validateOnly($field);
    }
    
    protected function rules()
    {
        return [
            'dataKey'           => 'required|numeric',
            'image'             => 'nullable|required_if:editImage,true|mimes:jpeg,jpg,png,gif,webp|max:10000',
            'url'               => 'nullable|url',

            'editUrl'           => 'required|boolean',
            'editImage'         => 'required|boolean',
            
            'editMarginTop'     => 'required|boolean',
            'editMarginBottom'  => 'required|boolean',
            'marginTop'         => 'required|numeric',
            'marginBottom'      => 'required|numeric',
            'marginTopUnit'     => 'required|in:px,rem,in,vh',
            'marginBottomUnit'  => 'required|in:px,rem,in,vh',

            'x'                 => 'nullable|numeric',
            'y'                 => 'nullable|numeric',
            'width'             => 'nullable|numeric',
            'height'            => 'nullable|numeric',
        ];
    }

    public function finalValidation()
    {
        $arr = [];
        if ($this->editImage) {
            $arr += [
                'image' => 'required',
                'x'     => 'required',
                'y'     => 'required',
                'width' => 'required',
                'height' => 'required',
            ];
        }
      
        if ($this->editMarginTop) {
            $arr += [
                'marginTop'     => 'required',
                'marginTopUnit' => 'required',
            ];
        }
        if ($this->editMarginBottom) {
            $arr += [
                'marginBottom'      => 'required',
                'marginBottomUnit'  => 'required',
            ];
        }
        if (count($arr)) {
            $this->validate($arr);
        }
        
    }

    public function mount()
    {
        $this->marginTop = $this->component->style->marginTop->value;
        $this->marginTopUnit = $this->component->style->marginTop->unit;
        $this->marginBottom = $this->component->style->marginBottom->value;
        $this->marginBottomUnit = $this->component->style->marginBottom->unit;

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
        $this->finalValidation();
        
        if ($this->editMarginTop) {
            $marginTop = $this->marginTop;
            $marginTopUnit = $this->marginTopUnit;
        } else {
            $marginTop = $this->component->style->marginTop->value;
            $marginTopUnit = $this->component->style->marginTop->unit;
        }

        if ($this->editMarginBottom) {
            $marginBottom = $this->marginBottom;
            $marginBottomUnit = $this->marginBottomUnit;
        } else {
            $marginBottom = $this->component->style->marginBottom->value;
            $marginBottomUnit = $this->component->style->marginBottom->unit;
        }

        $style = [
            'marginTop' => [
                'value' => $marginTop,
                'unit' => $marginTopUnit,
            ],
            'marginBottom' => [
                'value' => $marginBottom,
                'unit' => $marginBottomUnit,
            ],
        ];
     
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
        
        $this->component->update([
            'data' => json_encode($data),
            'style' => json_encode($style),
            'visible' => $this->visibility,
        ]);

        $this->emit('modal', [
            'el' => '#EditComponentModal-'.$this->component->id,
            'action' => 'hide',
        ]);
        $this->reset(['editImage', 'image', 'editUrl']);
    }

    public function render()
    {
        return view('livewire.home.home-components.banner-component');
    }
}
