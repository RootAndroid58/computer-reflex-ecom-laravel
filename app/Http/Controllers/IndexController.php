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
        
        $BestSellingProducts = Product::with('images')->with('stars')->where('product_status', 1)->whereIn('id', [
                1,2,3,4,5,6,7,8,9,10
            ])->get();

        // Top Products Section
        $topProducts1 = Product::with('images')->with('stars')->where('product_status', 1)->whereIn('id', [
                4,2,
            ])->get();

        $topProducts2 = Product::with('images')->with('stars')->where('product_status', 1)->whereIn('id', [
                3,
            ])->get();

        $topProducts3 = Product::with('images')->with('stars')->where('product_status', 1)->whereIn('id', [
                5,
            ])->get();

            // dd($sections);

        return view('index', [
            'banners'               => $banners,
            'sections'              => $sections,
            'categories'            => $categories,
            'BestSellingProducts'   => $BestSellingProducts,
            'topProducts1'          => $topProducts1,
            'topProducts2'          => $topProducts2,
            'topProducts3'          => $topProducts3,
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

        // $products = Product::with(['images', 'tags', 'category'])
        
        //     ->where('product_status', 1)
        //     ->where(function ($query) use ($searchArr) {
        //         foreach ($searchArr as $search) {
        //             $query->orWhere('id', 'LIKE' , '%'.$search.'%')
        //             ->orWhere('product_name', 'LIKE' , '%'.$search.'%')
        //             ->orWhere('product_brand', 'LIKE' , '%'.$search.'%')
        //             ->orWhereHas('tags', function ($query) use ($search) {
        //                 $query->where('product_tag', 'LIKE', '%'.$search.'%');
        //             });
        //         }
        //     });
            

                
        //     $products->whereBetween('product_price', [$min_price, $max_price])
            
            
        //     ->where('product_stock', '>=', $stock)
        //     ;

        // dd(1);



        // $products = Product::search($req->search)->get();

         
        $products = Product::search($req->search)
        ->where('product_status', 1)
        ->where('product_stock', '>=', $stock)
        ->whereBetween('product_price', [$min_price, $max_price]);

        
        if ($cat != 'ALL' && $cat != '') {
            $products->whereHas('category', function ($query) use ($cat) { 
                $query->where('category', $cat);
           });
        }
        $ProductsCount = $products->count(); 

        $products = $products->paginate(12)->appends(request()->query());
        
        // dd($products);
           

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
