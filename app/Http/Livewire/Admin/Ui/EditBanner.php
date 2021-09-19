<?php

namespace App\Http\Livewire\Admin\Ui;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBanner extends Component
{
    use WithFileUploads;
    
    public $bannerId;
    public $banner;
    public $bannerType="imageOnly";
    public $bannerName;
    public $editImage=false;
    public $bannerImage;
    public $header;
    public $header2;
    public $caption;
    public $buttonText;
    public $buttonLink;

    public function rules()
    {
        return [
            "bannerType"    => 'required|in:imageOnly,imageText',
            "bannerName"    => 'required|max:255|unique:banners,banner_name,'.$this->bannerId,
            "bannerImage"   => 'required_if:editImage,true|nullable|mimes:jpeg,jpg,png,webp',
            "buttonLink"    => 'required',
            "header"        => 'required_if:bannerType,imageText|max:50',
            "header2"       => 'required_if:bannerType,imageText|max:50',
            "caption"       => 'required_if:bannerType,imageText|max:255',
            "buttonText"    => 'required_if:bannerType,imageText|max:255',
        ]; 
    }
    
    public function mount()
    {
        $this->banner = Banner::where('id', $this->bannerId)->first();

        if ($this->banner->banner_header) {
            $this->bannerType = 'imageText';
        }

        $this->bannerName = $this->banner->banner_name;
        $this->header = $this->banner->banner_header;
        $this->header2 = $this->banner->banner_header_2;
        $this->caption = $this->banner->banner_caption;
        $this->buttonText = $this->banner->banner_btn_txt;
        $this->buttonLink = $this->banner->banner_btn_link;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function editBanner()
    {
        $this->validate();
        
        Banner::where('id', $this->bannerId)->update([
            'banner_name' => $this->bannerName,
            'banner_header' => $this->header,
            'banner_header_2' => $this->header2,
            'banner_caption' => $this->caption,
            'banner_btn_txt' => $this->buttonText,
            'banner_btn_link' => $this->buttonLink,
        ]);

        if ($this->editImage == true) {
            $imageName = md5_file($this->bannerImage->getRealPath()).'.'.$this->bannerImage->getClientOriginalExtension();
            $this->bannerImage->storeAs('images/banner', $imageName, 'public');
            Banner::where('id', $this->bannerId)->update([
                'banner_img' => $imageName,
            ]);
        }

        

        // After update
        $this->emit('toastAlert', [
            'type'      => 'SUCCESS',
            'title'     => 'Banner Updated',
            'caption'   => 'Banner ('.$this->bannerName.') Updated Successfully',
        ]);
        $this->emit('modal', [
            'el'        => '#editBannerModal',
            'action'    => 'hide',
        ]);

        $this->emitUp('refresh');

    }

    public function render()
    {
        return view('livewire.admin.ui.edit-banner');
    }
}
