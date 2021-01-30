<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function ShowCart()
    {
        return view('cart');
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
