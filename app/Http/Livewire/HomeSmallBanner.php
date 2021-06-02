<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeSmallBanner extends Component
{
    public $SmallBanner;
    public $isReady;

    public function DocReady()
    {
        $this->isReady = true; 
    }

    public function render()
    {
        return view('livewire.home-small-banner');
    }
}
