<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\SessionCart;
use Session;
use Auth;

class CartController extends Controller
{
    public function Test(Request $req)
    {
        dd(Session::getId());

        // $req->session()->forget('cart');
        // $cart = [
        //             'product_id'    => 2,
        //             'qty'           => 20,
        //         ];  
        
        // request()->session()->push('cart', $cart);

        // session()->save();
        
    }

    public function ShowCart()
    {
        if (Auth::check()) 
        {
            $cartQuery = Cart::where('user_id', Auth()->user()->id)->get();
        
            foreach ($cartQuery as $item ) {
                if ($item->qty > $item->Products[0]->product_stock) {
                    Cart::where('id', $item->id)->update([
                        'qty' => 1,
                    ]);
                }
            }
    
            $cart = Cart::where('user_id', Auth()->user()->id)->with('Products','Images')->orderBy('id', 'asc')->get();
        }
        else 
        {
            $cartQuery = SessionCart::where('session_id', Session::getId())->get();
        
            foreach ($cartQuery as $item ) {
                if ($item->qty > $item->Products[0]->product_stock) {
                    SessionCart::where('id', $item->id)->update([
                        'qty' => 1,
                    ]);
                }
            }
    
            $cart = SessionCart::where('session_id', Session::getId())->with('Products','Images')->orderBy('id', 'asc')->get();
        }

        return view('cart', [
            'cart'      => $cart,
        ]);
    }


    public function ToggleCart(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        if (Auth::check()) 
        {
            $CartCheck = Cart::where('user_id', Auth()->user()->id)->where('product_id', $req->product_id)->first();

            if (!isset($CartCheck)) {
                $Cart = new Cart;
                $Cart->user_id = Auth()->user()->id;
                $Cart->product_id = $req->product_id;
                $Cart->qty = 1;
                $Cart->save();
    
                return 200;
    
            } else {
                $CartCheck->delete();
    
                return 500;
            }
        }
        else 
        {
            $CartCheck = SessionCart::where('session_id', Session::getId())->where('product_id', $req->product_id)->first();

            if (!isset($CartCheck)) {
                $Cart = new SessionCart;
                $Cart->session_id = Session::getId();
                $Cart->product_id = $req->product_id;
                $Cart->qty = 1;
                $Cart->save();
    
                return 200;
    
            } else {
                $CartCheck->delete();
    
                return 500;
            }
        }

    }

    public function ChangeQty(Request $req)
    {
        Cart::where('product_id', $req->product_id)->where('user_id', Auth()->user()->id)->update([
            'qty' => $req->cart_qty,
        ]);

        return 200;
    }


}
