<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Cart;
use App\Models\SessionCart;
use Session;

class CartCount extends Component
{
    public $page;

    protected $listeners = [
        'cartAdded' => 'render',
        'cartRemoved' => 'render',
    ];

    public function CartCount()
    {
        if (Auth()->check()) {
            $cartCount = Cart::where('user_id', Auth()->user()->id)->get()->count();
        } 
        else {
            $cartCount = SessionCart::where('session_id', Session::getId())->get()->count();
        }

        return $cartCount;
    }

    public function render()
    {
        return view('livewire.cart-count', [
            'cartCount' => $this->CartCount(),
        ]);
    }
}
