<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Events\QuickActionEvent;
use App\Models\SessionCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\WishlistController;

class BasicHelper extends Component
{

    // public $carted;
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
        $authCheck = Auth::check();
        
        if ($ToggleCart['status'] == 200 || $ToggleCart['status'] == 500) {
            event(new QuickActionEvent([
                'type'          => 'cart',
                'auth'          => $authCheck,
                'user_id'       => Auth()->user()->id ?? Session::getId(),
                'action'        => ($ToggleCart['status'] == 200) ? 'cartAdded' : 'cartRemoved',
                'product_id'    => $product_id,
                'product_name'  => WordLimit($ToggleCart['product_name'], 18).'...',
                'cart_count'    => ($authCheck) ? Cart::where('user_id', Auth::user()->id)->count() : SessionCart::where('session_id', Session::getId())->count(),
            ]));
        }
    }

    public function ToggleCompare($product_id)
    {
        Request()->request->add(['product_id' => $product_id]);
        
        $ToggleCompare = new CompareController;
        $ToggleCompare = $ToggleCompare->ToggleCompare(Request());

        if ($ToggleCompare['status'] == 200 || $ToggleCompare['status'] == 500) {
            $authCheck = Auth::check();
            event(new QuickActionEvent([
                'type'          => 'compare',
                'auth'          => $authCheck,
                'user_id'       => Auth()->user()->id ?? Session::getId(),
                'action'        => ($ToggleCompare['status'] == 200) ? 'compareAdded' : 'compareRemoved',
                'product_id'    => $product_id,
                'product_name'  => WordLimit($ToggleCompare['product_name'], 18).'...',
            ]));
        } 
    }

    public function ToggleWishlist($product_id)
    {
        abort_unless(Auth::check(), '403', 'Unauthorized.');

        Request()->request->add(['product_id' => $product_id]);
        
        $ToggleWishlist = new WishlistController;
        $ToggleWishlist = $ToggleWishlist->ToggleWishlist(Request());

        if ($ToggleWishlist['status'] == 200 || $ToggleWishlist['status'] == 500) {
            $authCheck = Auth::check();
            event(new QuickActionEvent([
                'type'          => 'wishlist',
                'auth'          => $authCheck,
                'user_id'       => Auth()->user()->id,
                'action'        => ($ToggleWishlist['status'] == 200) ? 'wishlistAdded' : 'wishlistRemoved',
                'product_id'    => $product_id,
                'product_name'  => WordLimit($ToggleWishlist['product_name'], 18).'...',
            ]));
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
