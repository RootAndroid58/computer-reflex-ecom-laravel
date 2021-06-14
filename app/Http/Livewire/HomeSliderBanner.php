<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeSliderBanner extends Component
{
    public $banner;
    

    public function render()
    {
        return view('livewire.home-slider-banner');
    }
}
