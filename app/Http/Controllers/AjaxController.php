<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\SmallBanner;
use App\Models\ProductQuestion;

class AjaxController extends Controller
{
    public function GetAuthName(Request $req)
    {
        return Auth()->user()->name;
    }
    public function GetSmallBannerData(Request $req)
    {
        $SmallBanner = SmallBanner::where('id', $req->banner_id)->first();
       
        if (!isset($SmallBanner)) {
            $status = 500;
        } else {
            $status = 200;
            $size = "Any";
            if ($SmallBanner->id <= 3) {
                $size = '430x275 Px';
            }
            if ($SmallBanner->id > 3 && $SmallBanner->id <= 5) {
                $size = '1920x400 Px';
            }
        }
    
        return [
            'SmallBanner'   => $SmallBanner,
            'status'        => $status,
            'size'          => $size,
        ];
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

    public function SyncPrice(Request $req)
    {
        $mrp = 0;
        $price = 0;
        $discount = 0;

        foreach ($req->product_ids as $key => $product_id) {
            $product = Product::where('id', $product_id)->first();
            $price  = $price + ($product->product_price * $req->qtys[$key]); 
            $mrp    = $mrp + ($product->product_mrp * $req->qtys[$key]); 
        }

        $discount = $mrp-$price;

        return [
            'mrp'       => moneyFormatIndia($mrp),
            'price'     => moneyFormatIndia($price),
            'discount'  => moneyFormatIndia($discount),
        ];
    }

    public function GetProductReviews(Request $req)
    {
        $searchArr = preg_split('/\s+/', $req->get('review_search'), -1, PREG_SPLIT_NO_EMPTY); 

        $reviews = ProductReview::with('user')->where('product_id', $req->product_id);
        
        $reviews = $reviews->where(function ($query) use ($searchArr) {
                $query->orWhereNotNull('title')
                ->orWhereNotNull('message');
        });

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

        $TotalReviews = $reviews->count();
        $reviews = $reviews->skip($req->skip_count)->take(1)->get();

        foreach ($reviews as $review) {
            $review->days_ago = HowMuchOldDate($review->created_at, 'days');
        }
        
        return [
            'status'        => 200,
            'reviews'       => $reviews,
            'reviewsCount'  => $TotalReviews,
        ];
    }






    
    public function GetProductQnas(Request $req)
    {
        $qnas = ProductQuestion::with('answers')->with('user')
        ->search($req->review_search)
        ->where('product_id', $req->product_id);
        

        if ($req->sort_by == 'Newest First') {
            $qnas = $qnas->orderBy('id', 'desc');
        }
        if ($req->sort_by == 'Oldest First') {
            $qnas = $qnas->orderBy('id', 'asc');
        }


        $TotalQnas = $qnas->count();
        $qnas = $qnas->skip($req->skip_count)->take(1)->get();

        foreach ($qnas as $qna) {
            $qna->days_ago = HowMuchOldDate($qna->created_at, 'days');
        }
        
        return [
            'status'     => 200,
            'qnas'       => $qnas,
            'qnasCount'  => $TotalQnas,
        ];
    }


}
