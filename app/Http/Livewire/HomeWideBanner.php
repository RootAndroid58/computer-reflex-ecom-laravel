<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeWideBanner extends Component
{   
    public $SmallBanner;
    public $isReady;

    public function DocReady()
    {
        $this->isReady = true; 
    }
    
    public function render()
    {
        return view('livewire.home-wide-banner');
    }
}
