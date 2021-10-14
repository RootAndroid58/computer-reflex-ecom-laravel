<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Cart;
use App\Models\Product;
use App\Models\SessionCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

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


    static function ToggleCart(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::where('id', $req->product_id)->first();

        if (Auth::check()) 
        {
            $CartCheck = Cart::with('Products')->where('user_id', Auth()->user()->id)->where('product_id', $req->product_id)->first();

            if (!isset($CartCheck)) {
                $Cart = new Cart;
                $Cart->user_id = Auth()->user()->id;
                $Cart->product_id = $req->product_id;
                $Cart->qty = 1;
                $Cart->save();
    
                return [
                    'status' => 200,
                    'product_name' => $product->product_name,
                ];
    
            } else {
                
                $CartCheck->delete();

                return [
                    'status' => 500,
                    'product_name' => $product->product_name,
                ];
            }
        }
        else 
        {
            $CartCheck = SessionCart::with('products')->where('session_id', Session::getId())->where('product_id', $req->product_id)->first();

            if (!isset($CartCheck)) {
                $Cart = new SessionCart;
                $Cart->session_id = Session::getId();
                $Cart->product_id = $req->product_id;
                $Cart->qty = 1;
                $Cart->save();
    
                return [
                    'status' => 200,
                    'product_name' => $product->product_name,
                ];
    
            } else {
                $CartCheck->delete();

                return [
                    'status' => 500,
                    'product_name' => $product->product_name,
                ];

            }
        }

    }

    public function ChangeQty(Request $req)
    {

        if (Auth::check()) {
            Cart::where('product_id', $req->product_id)->where('user_id', Auth()->user()->id)->update([
                'qty' => $req->cart_qty,
            ]);
        }
        else {
            SessionCart::where('product_id', $req->product_id)->where('session_id', Session::getId())->update([
                'qty' => $req->cart_qty,
            ]);
        }
        
        return 200;
    }


}
