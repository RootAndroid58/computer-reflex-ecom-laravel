<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CompareController;

class ProductQuickActions extends Component
{
    public $carted;
    public $wishlisted;
    public $compared;
    public $product;

    public function ToggleCart($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);

        $ToggleCart = CartController::ToggleCart(Request());

        if ($ToggleCart == 200) {
            $this->carted = 1;
        } 
        elseif ($ToggleCart == 500) {
            $this->carted = 0;
        }
    }

    public function ToggleWishlist($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);

        $ToggleWishlist = WishlistController::ToggleWishlist(Request());

        if ($ToggleWishlist == 200) {
            $this->wishlisted = 1;
        } 
        elseif ($ToggleWishlist == 500) {
            $this->wishlisted = 0;
        }
    }

    public function ToggleCompare($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);
        
        $ToggleCompare = CompareController::ToggleCompare(Request());

        if ($ToggleCompare['status'] == 200) {
            $this->compared = 1;
        } 
        elseif ($ToggleCompare['status'] == 500) {
            $this->compared = 0;
        }
    }

    public function render()
    {
        return view('livewire.product-quick-actions');
    }
}
