<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Specification;
use App\Models\Cart;
use App\Models\Order;
use App\Models\SessionCart;
use App\Models\Wishlist;
use App\Models\ProductReview;
use App\Models\AffiliateLink;
use App\Models\Compare;
use Auth;
use Str;
use Session;

class ShowProductsController extends Controller
{
    public function ProductIndex($pid)
    {
        $product = Product::with('tags')->where('id', $pid)->first();

        if ($product->product_status == 1) {
            
            $images = ProductImage::Where('product_id' , $pid)->orderBy('id', 'desc')->get();
            $specifications = Specification::Where('product_id' , $pid)->orderBy('id', 'asc')->get();
            $category = Category::where('id' , $product->product_category_id)->first();
            $discount = ((($product->product_mrp - $product->product_price) / $product->product_mrp)*100)%100;
            $RelatedProducts = Product::where('product_status', 1)->with('images')
            ->where('product_category_id', $product->product_category_id)
            ->where(function ($query) use ($product) {
                foreach ($product->tags as $search) {
                    $query->orWhere('product_name', 'LIKE' , '%'.$search->product_tag.'%')
                    ->orWhere('product_brand', 'LIKE' , '%'.$search->product_tag.'%')
                    ->orWhere('product_description', 'LIKE' , '%'.$search->product_tag.'%');
                }
                $query->orWhereHas('tags', function ($query) use ($product) {
                    foreach ($product->tags as $search) {
                        $query->orWhere('product_tag', 'LIKE', '%'.$search->product_tag.'%');
                    }
                });
            })->take(10)->get();
            $reviews = ProductReview::with('user')->where('product_id', $pid)->take(5);
            
            $TotalStars = 0;

            if ($reviews->count() > 0) {
                foreach ($reviews->get('stars') as $review) {
                    $TotalStars += $review->stars;
                }
    
                $stars = $TotalStars/$reviews->get('stars')->count();
            } else {
                $stars = 0;
            }


            if (Auth::check()) {
                
                $ReviewCheck = ProductReview::where('product_id', $pid)->where('user_id', Auth()->user()->id)->first();
                
                $wishlistCheck = Wishlist::where('user_id', Auth()->user()->id ?? 'Fake')->where('product_id', $pid)->first();
                
                $compareCheck = Compare::where('user_id', Auth()->user()->id ?? 'Fake')->where('product_id', $pid)->first();
                
                $OrderCheck = Order::where('user_id', Auth()->user()->id)
                ->whereHas('OrderItems', function ($query) use ($pid) {
                    $query->where('product_id', $pid);
                })->first();

                $cartCheck = Cart::where('user_id', Auth()->user()->id)->where('product_id', $pid)->first();
            } 
            else 
            {
                $cartCheck = SessionCart::where('session_id', Session::getId())->where('product_id', $pid)->first();
            }

            if (isset($compareCheck)) {
                $compared = 1;
            } else {
                $compared = 0;
            }

            if (isset($wishlistCheck)) {
                $wishlisted = 1;
            } else {
                $wishlisted = 0;
            }

            if (isset($OrderCheck)) {
                $ordered = 1;
            } else {
                $ordered = 0;
            }

            if (isset($ReviewCheck)) {
                $reviewed = 1;
            } else {
                $reviewed = 0;
            }

            if (isset($cartCheck)) {
                $carted = 1;
            } else {
                $carted = 0;
            }
            if ($RelatedProducts->count() == 0) {
                $RelatedProducts = null;
            }

            $ratingCounts = [
                'five' => ProductReview::where('stars', 5)->where('product_id', $product->id)->get()->count(),
                'four' => ProductReview::where('stars', 4)->where('product_id', $product->id)->get()->count(),
                'three' => ProductReview::where('stars', 3)->where('product_id', $product->id)->get()->count(),
                'two' => ProductReview::where('stars', 2)->where('product_id', $product->id)->get()->count(),
                'one' => ProductReview::where('stars', 1)->where('product_id', $product->id)->get()->count(),
            ]; 
    
            $maxRatingCount = max($ratingCounts);
            if ($maxRatingCount != 0) {
                $ratingPerc = [
                    'fivePerc'  => ($ratingCounts['five']*100)/$maxRatingCount,
                    'fourPerc'  => ($ratingCounts['four']*100)/$maxRatingCount ,
                    'threePerc' => ($ratingCounts['three']*100)/$maxRatingCount,
                    'twoPerc'   => ($ratingCounts['two']*100)/$maxRatingCount,
                    'onePerc'   => ($ratingCounts['one']*100)/$maxRatingCount,
                ];
            } else { 
                $ratingPerc = [
                    'fivePerc'  => 0,
                    'fourPerc'  => 0,
                    'threePerc' => 0,
                    'twoPerc'   => 0,
                    'onePerc'   => 0,
                ];
             }
             
             if (Auth::check()) {
                if (Auth()->user()->can('Affiliate')) {
                    $affiliateLink = AffiliateLink::where('associate_id', Auth()->user()->id)->where('product_id', $product->id)->first();
                     if (!isset($affiliateLink)) {
                        $affiliateLink = new AffiliateLink;
                        $affiliateLink->associate_id = Auth()->user()->id;
                        $affiliateLink->short_url = Str::random(8);
                        $affiliateLink->product_id = $product->id;
                        $affiliateLink->save();
                    }
                } else { $affiliateLink = null; }
             }
             
            

            return view('product-details', [
                'product'           => $product,
                'stars'             => $stars,
                'ordered'           => $ordered,
                'ReviewCheck'       => $ReviewCheck ?? null,
                'reviewed'          => $reviewed,
                'compared'          => $compared,
                'reviews'           => $reviews->get(),
                'RelatedProducts'   => $RelatedProducts,
                'images'            => $images,
                'category'          => $category,
                'discount'          => $discount,
                'carted'            => $carted,
                'wishlisted'        => $wishlisted,
                'specifications'    => $specifications,
                'ratingCounts'      => $ratingCounts,
                'ratingPerc'        => $ratingPerc,
                'affiliateLink'     => $affiliateLink ?? null,
            ]);

        } else {
            return 'This product is currently inactive';
        }

    }
}
