<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarouselProducts extends Component
{
    public $product;

    protected function getListeners()
    {
        return ['refreshProduct:'.$this->product->id => '$refresh'];
    }

    public function render()
    {
        return view('livewire.carousel-products');
    }
}
