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
        if (isset($req->min_price)) { $min_price = $req->min_price; } else { $min_price = 0; }
        if (isset($req->max_price)) { $max_price = $req->max_price; } else { $max_price = 9999999999999999999999999999999999; }
        if (isset($req->stock)) { $stock = $req->stock; } else { $stock =  null;}

        if ($req->stock == 'checked') {
            $stock = 0;
        } else {
            $stock = 1;
        }
        // dd($req);
        $cat = (strtoupper($req->category)) ?? '';

        // split on 1+ whitespace & ignore empty (eg. trailing space)
        $searchArr = preg_split('/\s+/', $req->get('search'), -1, PREG_SPLIT_NO_EMPTY); 

        $products = Product::with(['images', 'tags', 'category'])
            
            ->where(function ($query) use ($searchArr) {
                foreach ($searchArr as $search) {
                    $query->orWhere('id', 'LIKE' , '%'.$search.'%')
                    ->orWhere('product_name', 'LIKE' , '%'.$search.'%')
                    ->orWhere('product_brand', 'LIKE' , '%'.$search.'%')
                    ->orWhere('product_description', 'LIKE' , '%'.$search.'%');
                }
            })
            ->whereHas('tags', function ($query) use ($searchArr) {
                foreach ($searchArr as $search) {
                    $query->orWhere('product_tag', 'LIKE', '%'.$search.'%');
                }
            });

            if ($cat != 'ALL' && $cat != '') {
                $products->whereHas('category', function ($query) use ($cat) { 
                    $query->where('category', $cat);
               });
            }
                
            $products->whereBetween('product_price', [$min_price, $max_price])
            
            ->where('product_stock', '>=', $stock)
            ;
                
            
        $count = $products->count();    
         
        $products = $products->skip(0)->take(30)->get();
        
        $paginate = ceil($count/30);
        
        // dd($paginate, $count);
        $categories = Category::get();

        return view('searched-products', [
            'products'          => $products,
            'categories'        => $categories,
            'paginate'          => $paginate,
        ]);
    }
    
}
