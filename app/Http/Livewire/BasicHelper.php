<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\WishlistController;

class BasicHelper extends Component
{

    public $carted;
    public $wishlisted;
    public $compared;

    protected $listeners = [
        'ToggleCart' => 'ToggleCart',
        'ToggleCompare' => 'ToggleCompare',
        'ToggleWishlist' => 'ToggleWishlist',
    ];

    public function ToggleCart($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);
    
        $ToggleCart = new CartController;
        $ToggleCart = $ToggleCart->ToggleCart(Request());

        if ($ToggleCart['status'] == 200) {
            $this->carted = 1;
            $this->emit('refreshProduct:'.$product_id);
            $this->emit('cartAdded', WordLimit($ToggleCart['product_name'], 18).'...');
        }
        elseif ($ToggleCart['status'] == 500) {
            $this->carted = 0;
            $this->emit('refreshProduct:'.$product_id);
            $this->emit('cartRemoved', WordLimit($ToggleCart['product_name'], 18).'...');
        }
    }

    public function ToggleCompare($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);
        
        $ToggleCompare = new CompareController;
        $ToggleCompare = $ToggleCompare->ToggleCompare(Request());

        if ($ToggleCompare['status'] == 200) {
            $this->compared = 1;
            $this->emit('refreshProduct:'.$product_id);
            $this->emit('compareAdded', WordLimit($ToggleCompare['product_name'], 18).'...');
        } 
        elseif ($ToggleCompare['status'] == 500) {
            $this->compared = 0;
            $this->emit('refreshProduct:'.$product_id);
            $this->emit('compareRemoved', WordLimit($ToggleCompare['product_name'], 18).'...');
        }
    }

    public function ToggleWishlist($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);
        
        $ToggleWishlist = new WishlistController;
        $ToggleWishlist = $ToggleWishlist->ToggleWishlist(Request());

        if ($ToggleWishlist['status'] == 200) {
            $this->wishlistd = 1;
            $this->emit('refreshProduct:'.$product_id);
            $this->emit('wishlistAdded', WordLimit($ToggleWishlist['product_name'], 18).'...');
        } 
        elseif ($ToggleWishlist['status'] == 500) {
            $this->wishlistd = 0;
            $this->emit('refreshProduct:'.$product_id);
            $this->emit('wishlistRemoved', WordLimit($ToggleWishlist['product_name'], 18).'...');
        }
    }

    public function render()
    {
        return <<<'blade'
            <div>
                {{-- Because she competes with no one, no one can compete with her. --}}
            </div>
        blade;
    }
}
