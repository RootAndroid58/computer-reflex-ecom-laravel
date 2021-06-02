<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeSliderBanner extends Component
{
    public $banner;
    
    public $isReady = false;

    public function DocReady()
    {
        $this->isReady = true;
    }

    public function render()
    {
        return view('livewire.home-slider-banner');
    }
}
