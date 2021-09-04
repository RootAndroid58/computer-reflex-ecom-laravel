<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Storage;

use App\Http\Controllers\Admin\ManageOrdersController;

class WishlistController extends Controller
{
    public function ShowWishlist()
    {   
        Storage::disk('local')->put('attachments.png', 'https://computerreflex.dev/livewire/preview-file/FYMXvpNyzKrduiJn4dmd29KbhiWjfE-metaMS5wbmc=-.png?expires=1630711968&signature=a5150a399ba3aff2da2c96852f1d791853523a664f5f2862e05d7856b4486092');

        return view('wishlist');
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
