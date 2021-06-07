<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BestSellingSection extends Component
{
    public $product;

    protected function getListeners()
    {
        return ['refreshProduct:'.$this->product->id => '$refresh'];
    }

    public function render()
    {
        return view('livewire.best-selling-section');
    }
}
