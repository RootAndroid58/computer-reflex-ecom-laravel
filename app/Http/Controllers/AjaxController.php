<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AjaxController extends Controller
{
    public function GetAuthName(Request $req)
    {
        return Auth()->user()->name;
    }

    public function GetAuthEmail(Request $req)
    {
        return Auth()->user()->email;
    }

    public function GetAuthMobile(Request $req)
    {
        return Auth()->user()->mobile;
    }

    public function CalcMRPPrice(Request $req)
    {
        $product = Product::where('id', $req->ProdID)->first();

        return response()->json([
            'mrp'   => moneyFormatIndia($product->product_mrp * $req->qty), 
            'price' => moneyFormatIndia($product->product_price * $req->qty), 
        ]);
    }

}
