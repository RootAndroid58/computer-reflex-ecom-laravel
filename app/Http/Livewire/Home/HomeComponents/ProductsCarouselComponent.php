<?php

namespace App\Http\Livewire\Home\HomeComponents;

use Livewire\Component;

class ProductsCarouselComponent extends Component
{
    public $component;
    public $visibility;

    public function render()
    {
        return view('livewire.home.home-components.products-carousel-component');
    }
}
