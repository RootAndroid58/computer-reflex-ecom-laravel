<?php

namespace App\Http\Livewire\Admin\Ui;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageBanners extends Component
{
    use WithFileUploads;
    
    public $bannerType="imageOnly";
    public $bannerId;
    public $bannerName;
    public $bannerImage;
    public $header;
    public $header2;
    public $caption;
    public $buttonText;
    public $buttonLink;
    public $deleteBannerId;

    protected function rules()
    {

        $rules = [
            "bannerType"    => 'required|in:imageOnly,imageText',
            "bannerName"    => 'required|max:255|unique:banners,banner_name',
            "bannerImage"   => 'required_if:editBannerImage,true|mimes:jpeg,jpg,png',
            "buttonLink"    => 'required',
            "header"        => 'required_if:bannerType,imageText|max:50',
            "header2"       => 'required_if:bannerType,imageText|max:50',
            "caption"       => 'required_if:bannerType,imageText|max:255',
            "buttonText"    => 'required_if:bannerType,imageText|max:255',
        ];

        return $rules;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    

    public function create()
    {
        $this->validate();
        $imageName = md5_file($this->bannerImage->getRealPath()).'.'.$this->bannerImage->getClientOriginalExtension();
        $this->bannerImage->storeAs('images/banner', $imageName, 'public');
        
        $banner = new Banner;
        $banner->banner_name        = $this->bannerName;
        $banner->banner_header      = $this->header;
        $banner->banner_header_2    = $this->header2;
        $banner->banner_caption     = $this->caption;
        $banner->banner_btn_txt     = $this->buttonText;
        $banner->banner_btn_link    = $this->buttonLink;
        $banner->banner_btn_color   = '#1a1a1a';
        $banner->banner_img         = $imageName;
        $banner->banner_status      = true;
        
        $banner->save();

        $this->emit('toastAlert', [
            'type'      => 'SUCCESS',
            'title'     => 'Banner Created',
            'caption'   => 'Home Banner Created Successfully',
        ]);
        $this->emit('modal', [
            'el'        => '#newBannerModal',
            'action'    => 'hide',
        ]);
    }


    public function toggleBannerStatus($bannerId)
    {
        $banner = Banner::where('id', $bannerId)->first();
        if ($banner->banner_status == true) {
            $status = false;
        } else {
            $status = true;
        }
        Banner::where('id', $bannerId)->update([
            'banner_status' => $status,
        ]);
    }

    public function updatePosition($items)
    {
        foreach ($items as $key => $item) {
            Banner::where('id', $item['value'])->update([
                'position' => $item['order'],
            ]);
        }
    }

    public function deleteBannerById($bannerId)
    {
        $this->deleteBannerId = $bannerId;
    }

    public function deleteBanner()
    {
        Banner::where('id', $this->deleteBannerId)->delete();
        $this->emit('toastAlert', [
            'type'      => 'DANGER',
            'title'     => 'Banner Deleted',
            'caption'   => 'Home Banner Deleted Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.ui.manage-banners', [
            'banners' => Banner::orderBy('position', 'asc')->get(),
        ]);
    }
}
