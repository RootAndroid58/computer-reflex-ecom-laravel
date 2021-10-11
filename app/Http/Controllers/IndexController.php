<?php

namespace App\Http\Controllers;

use Distinct;
use App\Models\User;
use App\Models\Banner;
use App\Models\Catalog;
use App\Models\Product;
use MeiliSearch\Client;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\AffiliateLink;
use App\Models\Specification;
use MeiliSearch\Endpoints\Indexes;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function Index()
    {
        return view('index', [
            'banners'               => Banner::where('banner_status', true)->orderBy('position', 'ASC')->get(),
        ]);
    }
    
    public function Categories()
    {
        return view('mobile.categories');
    }
    
    public function Search(Request $req)
    {
        return view('searched-products');
    }


    public function ShortUrlRedirect($short_url)
    {
        $affiliateLink = AffiliateLink::where('short_url', $short_url)->first();
        if (!isset($affiliateLink)) {
            return redirect()->back();
        }
        return redirect()->to(route('product-index', $affiliateLink->product_id).'/?aff='.$affiliateLink->associate_id);
    }


    public function Catalog($slug, Request $req)
    {
        $catalog = Catalog::with('CatalogProducts.product')->where('slug', $slug)->first();
        $product_ids = $catalog->CatalogProducts->pluck('product_id');
     
        if (isset($req->min_price)) { 
            $min_price = $req->min_price; 
        } else {
            $min_price = 0; 
            $MinPriceUnset = true;
        }
        if (isset($req->max_price) && $req->max_price != 0) { 
            $max_price = $req->max_price; 
        } else { 
            $max_price = 9999999999999999999999999999999999; 
            $MaxPriceUnset = true;
        }
    
        if ($req->stock == 'checked') {
            $stock = 0;
        } else {
            $stock = 1;
        }
        // dd($req);
        $cat = (strtoupper($req->category)) ?? '';

        $categories = Category::get();
         
        $products = Product::with('specifications')->search($req->search)
        ->whereIn('id', $product_ids)
        ->where('product_status', 1)
        ->where('product_stock', '>=', $stock)
        ->whereBetween('product_price', [$min_price, $max_price]);

        if (isset($req->specs) && $req->specs > 0) {
            $products->whereHas('specifications', function ($query) use ($req) {
                foreach ($req->specs as $key => $value) {
                    $query->where('specification_key', $key)
                            ->where('specification_value', $value);
                }
            });
        }

        if (isset($req->brands) && count($req->brands) > 0) {
            $products->whereIn('product_brand', $req->brands);
        }
        
        if ($cat != 'ALL' && $cat != '') {
            $products->whereHas('category', function ($query) use ($cat) { 
                $query->where('category', $cat);
           });
        }
        if ($req->sort_by == 'A to Z') {
            $products->orderBy('product_name', 'asc');
        }
        if ($req->sort_by == 'Z to A') {
            $products->orderBy('product_name', 'desc');
        }
        if ($req->sort_by == 'Price Low to High') {
            $products->orderBy('product_price', 'asc');
        }
        if ($req->sort_by == 'Price High to Low') {
            $products->orderBy('product_price', 'desc');
        }   

        $specifications = Specification::whereIn('product_id', $products->pluck('id'))
        ->groupBy(['specification_key', 'specification_value']) // group by query
        ->get()
        ->groupBy('specification_key'); // group by collection
    
        // max($products->pluck('product_price')->toArray())

        if (isset($MinPriceUnset) && $products->pluck('product_price')->count() > 0) {
            $req->merge([
                'min_price' => min($products->pluck('product_price')->toArray()),
            ]);
        }
        if (isset($MaxPriceUnset) && $products->pluck('product_price')->count() > 0) {
            $req->merge([
                'max_price' => max($products->pluck('product_price')->toArray()),
            ]);
        }
       
        $brands = $products->get()->groupBy('product_brand');
        $ProductsCount = $products->count(); 
        $products = $products->paginate(12)->appends(request()->query());

        return view('searched-products', [
            'brands'            => $brands,
            'products'          => $products,
            'categories'        => $categories,
            'ProductsCount'     => $ProductsCount,
            'SpecsFilter'       => $specifications,
            'slug'              => $slug,
        ]);
    }
    
}












