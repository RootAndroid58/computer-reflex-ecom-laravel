<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Specification;
use MeiliSearch\Endpoints\Indexes;


class ProductSearchComponent extends Component
{
    use WithPagination;

    public $search;
    public $brands=[];
    public $categories=[];

    // Filtering Data
    public $sortBy;
    public $showOutOfStock;
    public $minPrice;
    public $maxPrice;
    public $categoryFilter;
    public $specsFilter=[];
    public $brandsFilter=[];

    public function mount(Request $req)
    {
        $this->search = $req->search;
        $this->categoryFilter = $req->category;
    }

    public function toggleBrandsFilter($brandKey)
    {
        $brandName = $this->brands[$brandKey];
        if (($key = array_search($brandName, $this->brandsFilter)) !== false) {
            unset($this->brandsFilter[$key]);
        } else {
            $this->brandsFilter[] = $brandName;
        }
    }

    public function render()
    {   
        // All prodocuts without any Filter 
        $allProducts = Product::search($this->search)->get();

        // All Brands & Categories wihout filtered
        $this->brands       = $allProducts->pluck('product_brand');
        $this->categories   = $allProducts->pluck('category');
        
        // All Specs Group wihout filtered
        $specsGroupArr = Specification::whereIn('product_id', $allProducts->pluck('id'))
        ->groupBy(['specification_key', 'specification_value']) // group by query
        ->get()
        ->groupBy('specification_key'); // group by collection
        
        // Initiatl Searched Products (Without any Filter)
        $filteredProducts = Product::whereIn('id', $allProducts->pluck('id'));

        // If Brand filter is set... Filter by Brands
        if (count($this->brandsFilter)) { 
            $filteredProducts = $filteredProducts->whereHas('category', function ($query) {
                $query->whereIn('product_brand', $this->brandsFilter);
            });
        }

        // If category filter is set... Filter by category
        if ($this->categoryFilter && !strcasecmp($this->categoryFilter, 'all') == 0) { 
            $filteredProducts = $filteredProducts->whereHas('category', function ($query) {
                $query->where('category', $this->categoryFilter);
            });
        }   

        if (!$this->showOutOfStock) {
            $filteredProducts = $filteredProducts->where('product_stock', '>', 1);
        }


        // Arrenge the Specs Filter Keys & Values
        $keys = []; $values = [];
        foreach ($this->specsFilter as $key => $value) {
            if ($value) {
                $specification = Specification::where('id', $key)->first();
                if (isset($specification)) {
                    $keys[] = $specification->specification_key;
                    $values[] = $specification->specification_value;
                }
            }
        }
        
        // Filter by Specifications if atleast one specifaction is checked
        if (isset($keys) && isset($values) && count($keys) && count($values)) {
            $filteredProducts = $filteredProducts->whereHas('specifications', function ($query) use ($keys, $values) {
                $query->whereIn('specification_key', $keys)
                ->whereIn('specification_value', $values);
            });
        }
        
        // If SortBy isset and not default... Sort by 
        $orderBy = productOrderBy($this->sortBy);
        if ($orderBy) {
            $filteredProducts = $filteredProducts->orderBy($orderBy['col'], $orderBy['order']);
        }

        // Render The Component
        return view('livewire.product-search-component', [ 
            'products'      => $filteredProducts->paginate(12),
            'allProducts'   => $allProducts,
            'specsGroupArr' => $specsGroupArr,
        ]);
    }
}
