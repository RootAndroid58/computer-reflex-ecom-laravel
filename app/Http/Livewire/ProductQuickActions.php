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

        if ($ToggleCart['status'] == 200) {
            $this->carted = 1;
            $this->emit('cartAdded', WordLimit($ToggleCart['product_name'], 18));
        } 
        elseif ($ToggleCart['status'] == 500) {
            $this->carted = 0;
            $this->emit('cartRemoved', WordLimit($ToggleCart['product_name'], 18));
        }
    }

    public function ToggleWishlist($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);

        $ToggleWishlist = WishlistController::ToggleWishlist(Request());

        if ($ToggleWishlist['status'] == 200) {
            $this->wishlisted = 1;
            $this->emit('wishlistAdded', WordLimit($ToggleWishlist['product_name'] ?? '', 18));
        } 
        elseif ($ToggleWishlist == 500) {
            $this->wishlisted['status'] = 0;
            $this->emit('wishlistAdded', WordLimit($ToggleWishlist['product_name'] ?? '', 18));
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
