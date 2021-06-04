<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ProductImage;

class WishlistController extends Controller
{
    public function ShowWishlist()
    {
        $wishlist = Wishlist::where('user_id', Auth()->user()->id)->with(['Products','Images', 'Cart'])->orderBy('id', 'asc')->get();
        
        $wishlistCount = $wishlist->count();
        // dd($wishlist);
        // dd( $wishlist->Products );

        return view('wishlist', [
            'wishlist'      => $wishlist,
            'wishlistCount' => $wishlistCount,
        ]);
    }


    
    public static function ToggleWishlist(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::where('id', $req->product_id)->first();
        $wishlistCheck = Wishlist::where('user_id', Auth()->user()->id)->where('product_id', $req->product_id)->first();

        if (!isset($wishlistCheck)) {
            $wishlist = new Wishlist;
            $wishlist->user_id = Auth()->user()->id;
            $wishlist->product_id = $req->product_id;
            $wishlist->save();

            return [
                'status' => 200,
                'product_name' => $product->product_name,
            ];

        } else {
            $wishlistCheck->delete();

            return [
                'status' => 500,
                'product_name' => $product->product_name,
            ];
        }

        

    }
}
