<?php

namespace App\Http\Livewire\Admin\Ui;

use App\Models\Banner;
use Livewire\Component;

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
            "bannerName"    => 'required|max:255|unique:banners,banner_name',
            "bannerImage"   => 'required_if:editBannerImage,true|mimes:jpeg,jpg,png',
            "buttonLink"    => 'required',
            "header"        => 'required_if:bannerType,imageText|max:50',
            "header2"       => 'required_if:bannerType,imageText|max:50',
            "caption"       => 'required_if:bannerType,imageText|max:255',
            "buttonText"    => 'required_if:bannerType,imageText|max:255',
        ]; 
    }

    public function mount()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->banner = Banner::where('id', $this->bannerId)->first();
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
    }

    public function render()
    {
        return view('livewire.admin.ui.edit-banner');
    }
}
