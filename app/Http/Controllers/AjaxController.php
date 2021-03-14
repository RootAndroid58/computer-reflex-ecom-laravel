<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductReview;

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

    public function GetProductReviews(Request $req)
    {
        $searchArr = preg_split('/\s+/', $req->get('review_search'), -1, PREG_SPLIT_NO_EMPTY); 

        $reviews = ProductReview::with('user')->where('product_id', $req->product_id);

        if (isset($req->review_search)) {
            $reviews = $reviews->where(function ($query) use ($searchArr) {
                foreach ($searchArr as $search) {
                    $query->orWhere('title', 'LIKE' , '%'.$search.'%')
                    ->orWhere('message', 'LIKE' , '%'.$search.'%');
                }
            });
        }
        if ($req->sort_by == 'Newest First') {
            $reviews = $reviews->orderBy('id', 'desc');
        }
        if ($req->sort_by == 'Oldest First') {
            $reviews = $reviews->orderBy('id', 'asc');
        }
        if ($req->sort_by == 'Positive First') {
            $reviews = $reviews->orderBy('stars', 'desc');
        }
        if ($req->sort_by == 'Negative First') {
            $reviews = $reviews->orderBy('stars', 'asc');
        }
        


        return [
            'status'        => 200,
            'reviews'       => $reviews->skip($req->skip_count)->take(5)->get(),
            'reviewsCount'  => $reviews->count(),
        ];
    }

}
