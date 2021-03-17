<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Order;

class ReviewController extends Controller
{
    public function ReviewSubmit(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'numeric|min:1|max:5',
            'title' => 'nullable|max:50',
            'message' => 'nullable|max:300',
        ]);

        $OrderCheck = Order::where('user_id', Auth()->user()->id)
        ->whereHas('OrderItems', function ($query) use ($req) {
            $query->where('product_id', $req->product_id);
        })->first();

        $ReviewCheck = ProductReview::where('product_id', $req->product_id)->where('user_id', Auth()->user()->id)->first();

        if (isset($OrderCheck) && !isset($ReviewCheck)) {
            $productReview              = new ProductReview;
            $productReview->stars       = $req->rating;
            $productReview->title       = $req->title;
            $productReview->message     = $req->message;
            $productReview->user_id     = Auth()->user()->id;
            $productReview->product_id  = $req->product_id;
            $productReview->save();
    
            return response()->json([
                'status' => 200,
                'message' => 'Thanks For Your Review/Rating.',
            ]);
        } 
        elseif (isset($OrderCheck) && isset($ReviewCheck)) {
            ProductReview::where('product_id', $req->product_id)->where('user_id', Auth()->user()->id)->update([
                'stars' => $req->rating,
                'title' => $req->title,
                'message' => $req->message,
            ]);

            return response()->json([
                'status' => 210,
                'message' => 'Review Updated Successfully.',
            ]);
        }
    }


    public function AllProductReviews($pid)
    {
        $product = Product::with('images')->where('id', $pid)->where('product_status', 1)->where('product_published', 1)->first();
        if (!isset($product)) {
            return redirect()->route('product-index', $pid);
        }
        $reviews = ProductReview::where('product_id', $pid);
        $ReviewCheck = ProductReview::where('product_id', $pid)->where('user_id', Auth()->user()->id)->first();

        if (isset($ReviewCheck)) {
            $reviewed = 1;
        } else {
            $reviewed = 0;
        }

        $TotalStars = 0;

        if ($reviews->count() > 0) {
            foreach ($reviews->get('stars') as $review) {
                $TotalStars += $review->stars;
            }
            $stars = $TotalStars/$reviews->get('stars')->count();
        } else {
            $stars = 0;
        }

        $ReviewCheck = ProductReview::where('product_id', $pid)->where('user_id', Auth()->user()->id)->first();
        if (isset($ReviewCheck)) {
            $reviewed = 1;
        } else {
            $reviewed = 0;
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
                'fourPerc'  => ($ratingCounts['four']*100)/$maxRatingCount,
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
    

        return view('product-reviews',[
            'product'           => $product,
            'reviews'           => $reviews->get(),
            'reviewed'          => $reviewed,
            'stars'             => $stars,
            'ratingCounts'      => $ratingCounts,
            'ratingPerc'        => $ratingPerc,
            'ReviewCheck'        => $ReviewCheck,
        ]);
    }
}
