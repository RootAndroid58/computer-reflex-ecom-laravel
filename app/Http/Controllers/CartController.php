<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function ShowCart()
    {
        $cart = Cart::where('user_id', Auth()->user()->id)->with('Products','Images')->orderBy('id', 'asc')->get();

        $cartCount = $cart->count();

        return view('cart', [
            'cart'      => $cart,
            'cartCount' => $cartCount,

        ]);
    }

    public function ChangeQty(Request $req)
    {
        Cart::where('product_id', $req->product_id)->where('user_id', Auth()->user()->id)->update([
            'qty' => $req->cart_qty,
        ]);

        return 200;
    }




    public function ToggleCart(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id',
        ]);

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


}
