<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;

class IndexController extends Controller
{
    public function Index()
    {
        $banners = Banner::where('banner_status', 1)->orderBy('banner_position', 'ASC')->get();

        return view('index', ['banners' => $banners]);
    }

    public function Search(Request $req)
    {

        // split on 1+ whitespace & ignore empty (eg. trailing space)
        $searchArr = preg_split('/\s+/', $req->get('search'), -1, PREG_SPLIT_NO_EMPTY); 

        $products = Product::with(['images', 'tags'])
            ->where('product_price', '>', $req->min_price)
            ->where(function ($query) use ($searchArr) {
                foreach ($searchArr as $search) {
                    $query->orWhere('id', 'LIKE' , '%'.$search.'%')
                    ->orWhere('product_name', 'LIKE' , '%'.$search.'%')
                    ->orWhere('product_brand', 'LIKE' , '%'.$search.'%')
                    ->orWhere('product_description', 'LIKE' , '%'.$search.'%');
                }
            })
            ->orWhereHas('tags', function ($query) use ($searchArr) {
                foreach ($searchArr as $search) {
                    $query->where('product_tag', 'LIKE', '%'.$search.'%');
                }
            })

            ->get();


        $categories = Category::get();

        return view('searched-products', [
            'products'      => $products,
            'categories'    => $categories,
        ]);
    }
}
