<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SmallBanner;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class HomeSmallBanner extends Component
{
    use WithFileUploads;

    public $SmallBanner;
    public $type;
    public $image;
    public $tempImage;
    public $url;
    public $editImage=false;
    public $editUrl=false;

    public $x;
    public $y;
    public $width;
    public $height;

    public function mount()
    {
        $this->url = $this->SmallBanner->link;
    }


    public function rules()
    {
        return [
            'image' => 'nullable|required_if:editImage,true|mimes:jpeg,jpg,png,gif,webp|max:10000',
            'url'   => 'nullable|required_if:editUrl,true|url',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedImage()
    {
        $aspectRatio = null;
        if ($this->type == 'small') {
            $aspectRatio = 8/5;
        }
        $this->emit('cropperInit-'.$this->SmallBanner->id, [
            'imageUrl' => $this->image->temporaryUrl(),
            'aspectRatio' => $aspectRatio,
        ]);
    }

    public function submit()
    {
        $this->validate();

        $data = [];

        if ($this->editUrl) {
            $data += [ 'link' => $this->url ];
        }
        if ($this->editImage) {
            // Store
            $this->image->store('images/banner', 'public');
            $data += [ 'image' => $this->image->hashName() ];
            $this->x = intval($this->x);
            $this->y = intval($this->y);
            $this->width = intval($this->width);
            $this->height = intval($this->height);
            // Crop
            Image::make(public_path('storage/images/banner/'.$this->image->hashName()))->crop($this->width, $this->height, $this->x, $this->y)->save();

            Storage::delete('/public/images/banner/'.$this->SmallBanner->image);
        }
        
        $this->SmallBanner->update($data);

        $this->emit('modal', [
            'el' => '.SmallBannerEditModal-'.$this->SmallBanner->id,
            'action' => 'hide',
        ]);

        $this->reset(['image', 'editImage', 'editUrl']);

    }

    public function render()
    {
        return view('livewire.home-small-banner');
    }
}
