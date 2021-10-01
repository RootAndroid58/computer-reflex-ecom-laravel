<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

        if (Auth::check()) {
            $auth = true;
        }

        if ($ToggleCart['status'] == 200) {
            $this->carted = 1;
            event(new \App\Events\CartEvent([
                'auth'          => $auth ?? false,
                'user_id'       => Auth()->user()->id ?? Session::getId(),
                'action'        => 'cartAdded',
                'product_id'    => $product_id,
                'product_name'  => WordLimit($ToggleCart['product_name'], 18).'...',
            ]));
        }
        elseif ($ToggleCart['status'] == 500) {
            $this->carted = 0;
            event(new \App\Events\CartEvent([
                'auth'          => $auth ?? false,
                'user_id'       => Auth()->user()->id ?? Session::getId(),
                'action'        => 'cartRemoved',
                'product_id'    => $product_id,
                'product_name'  => WordLimit($ToggleCart['product_name'], 18).'...',
            ]));
        }
    }

    public function ToggleCompare($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);
        
        $ToggleCompare = new CompareController;
        $ToggleCompare = $ToggleCompare->ToggleCompare(Request());

        if ($ToggleCompare['status'] == 200) {
            $this->compared = 1;
            $this->emit('compareAdded', [
                'product_id'    => $product_id,
                'product_name'  => WordLimit($ToggleCompare['product_name'], 18).'...',
            ]);
        } 
        elseif ($ToggleCompare['status'] == 500) {
            $this->compared = 0;
            $this->emit('compareRemoved', [
                'product_id'    => $product_id,
                'product_name'  => WordLimit($ToggleCompare['product_name'], 18).'...',
            ]);
        }
    }

    public function ToggleWishlist($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);
        
        $ToggleWishlist = new WishlistController;
        $ToggleWishlist = $ToggleWishlist->ToggleWishlist(Request());

        if ($ToggleWishlist['status'] == 200) {
            $this->wishlistd = 1;
            $this->emit('wishlistAdded', [
                'product_id' => $product_id,
                'product_name' => WordLimit($ToggleWishlist['product_name'], 18).'...',
            ]);
        } 
        elseif ($ToggleWishlist['status'] == 500) {
            $this->wishlistd = 0;
            $this->emit('wishlistRemoved', [
                'product_id' => $product_id,
                'product_name' => WordLimit($ToggleWishlist['product_name'], 18).'...',
            ]);
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
