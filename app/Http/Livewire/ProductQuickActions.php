<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CompareController;

class ProductQuickActions extends Component
{
    public $product;
    public $carted;
    public $wishlisted;
    public $compared;

    protected function getListeners()
    {
        return ['refreshProduct:'.$this->product->id => '$refresh'];
    }

    public function render()
    {
        return view('livewire.product-quick-actions');
    }
}
