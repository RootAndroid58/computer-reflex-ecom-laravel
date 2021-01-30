<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Specification;
use App\Models\Cart;
use App\Models\Wishlist;

class ShowProductsController extends Controller
{
    public function ProductIndex($pid, Request $req)
    {
        $product = Product::where('id', $pid)->first();

        if ($product->product_status == 1) {

            $images = ProductImage::Where('product_id' , $pid)->orderBy('id', 'desc')->get();
            $specifications = Specification::Where('product_id' , $pid)->orderBy('id', 'asc')->get();
            $category = Category::where('id' , $product->product_category_id)->first();
            $discount = ((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)%100;
            $wishlistCheck = Wishlist::where('user_id', Auth()->user()->id)->where('product_id', $pid)->first();
            $cartCheck = Cart::where('user_id', Auth()->user()->id)->where('product_id', $pid)->first();

            if (isset($wishlistCheck)) {
                $wishlisted = 1;
            } else {
                $wishlisted = 0;
            }

            if (isset($cartCheck)) {
                $carted = 1;
            } else {
                $carted = 0;
            }


            return view('product-details', [
                'product'           => $product,
                'images'            => $images,
                'category'          => $category,
                'discount'          => $discount,
                'carted'            => $carted,
                'wishlisted'        => $wishlisted,
                'specifications'    => $specifications,
            ]);

        } else {
            return 'This product is currently inactive';
        }

    }
}
