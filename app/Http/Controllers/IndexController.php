<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\AffiliateLink;


class IndexController extends Controller
{
    public function demo()
    {
        return view('test');
    }



    public function Index()
    {
        $banners = Banner::where('banner_status', 1)->orderBy('banner_position', 'ASC')->get();
        $categories = Category::get();
        $sections = HomeSection::with(['SectionProducts.product.images', 'SectionProducts.product.category'])->get();    

        // dd($sections);
        return view('index', [
            'banners'       => $banners,
            'sections'      => $sections,
            'categories'    => $categories,
        ]);
    }




    
    public function Search(Request $req)
    {
        if (isset($req->min_price)) { $min_price = $req->min_price; } else { $min_price = 0; }
        if (isset($req->max_price)) { $max_price = $req->max_price; } else { $max_price = 9999999999999999999999999999999999; }
    
        if ($req->stock == 'checked') {
            $stock = 0;
        } else {
            $stock = 1;
        }
        // dd($req);
        $cat = (strtoupper($req->category)) ?? '';

        // split on 1+ whitespace & ignore empty (eg. trailing space)
        $searchArr = preg_split('/\s+/', $req->get('search'), -1, PREG_SPLIT_NO_EMPTY); 

        $categories = Category::get();

        $products = Product::with(['images', 'tags', 'category'])->where('product_status', 1)
            
            ->where(function ($query) use ($searchArr) {
                foreach ($searchArr as $search) {
                    $query->orWhere('id', 'LIKE' , '%'.$search.'%')
                    ->orWhere('product_name', 'LIKE' , '%'.$search.'%')
                    ->orWhere('product_brand', 'LIKE' , '%'.$search.'%');
                }
                $query->orWhereHas('tags', function ($query) use ($searchArr) {
                    foreach ($searchArr as $search) {
                        $query->orWhere('product_tag', 'LIKE', '%'.$search.'%');
                    }
                });
            });
            

            if ($cat != 'ALL' && $cat != '') {
                $products->whereHas('category', function ($query) use ($cat) { 
                    $query->where('category', $cat);
               });
            }
                
            $products->whereBetween('product_price', [$min_price, $max_price])
            
            ->where('product_stock', '>=', $stock)
            ;
                
            
        $ProductsCount = $products->count();    
         
        $products = $products->paginate(12)->appends(request()->query());
        


        return view('searched-products', [
            'products'          => $products,
            'categories'        => $categories,
            'ProductsCount'     => $ProductsCount,
        ]);
    }


    public function ShortUrlRedirect($short_url)
    {
        $affiliateLink = AffiliateLink::where('short_url', $short_url)->first();
        if (!isset($affiliateLink)) {
            return redirect()->back();
        }
        return redirect()->to(route('product-index', $affiliateLink->product_id).'/?aff='.$affiliateLink->associate_id);
    }
    
}
