<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\ProductImage;

class WishlistController extends Controller
{
    public function ShowWishlist()
    {
        $data = Wishlist::with(['wishlist.images'])->get();

        return view('wishlist', [
            'data' => $data,

        ]);
    }




    public function ToogleWishlist(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlistCheck = Wishlist::where('user_id', Auth()->user()->id)->where('product_id', $req->product_id)->first();

        if (!isset($wishlistCheck)) {
            $wishlist = new Wishlist;
            $wishlist->user_id = Auth()->user()->id;
            $wishlist->product_id = $req->product_id;
            $wishlist->save();

            return 200;
        } else {

            $wishlistCheck->delete();

            return 500;
        }

        

    }
}
