<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Specification;
use App\Models\Wishlist;
use App\Models\Compare;
use App\Models\SessionCompare;
use App\Models\Cart;
use App\Models\SessionCart;
use Session;

use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory, SearchableTrait;

    protected $searchable = [
    /**
     * Searchable rules.
     *
     * @var array
     */


        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'groupBy'=> ['products.id'],

        'columns' => [
            'products.product_name' => 10,
            'products.tags' => 9,
            'products.product_brand' => 6,
            'products.product_description' => 3,
            'products.product_long_description' => 2,
            'products.product_price' => 7,
            'categories.category' => 8,
        ],
        'joins' => [
            'categories'  => ['categories.id','products.product_category_id'],
        ],
    ];


    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function licenses()
    {
        return $this->hasMany(ProductLicense::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function stars()
    {
        return $this->hasOne(ProductReview::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function getTagsAttribute($val)
    {
        return unserialize($val);
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'product_category_id')->orderBy('id', 'desc');
    }
    public function comission()
    {
        return $this->hasOne(ProductComission::class, 'product_id', 'id')->orderBy('id', 'desc');
    }

    public function questions()
    {
        return $this->hasMany(ProductQuestion::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function specifications()
    {
        return $this->hasMany(Specification::class, 'product_id', 'id');
    }


    public function carted()
    {
        if (Auth()->check()) {
            return $this->hasOne(Cart::class, 'product_id', 'id')->where('user_id', Auth()->user()->id);
        } else {
            return $this->hasOne(SessionCart::class, 'product_id', 'id')->where('session_id', Session::getId());
        }
    }

    public function wishlisted()
    {
        return $this->hasOne(Wishlist::class, 'product_id', 'id')->where('user_id', Auth()->user()->id ?? '');
    }

    public function compared()
    {
        if (Auth()->check()) {
            return $this->hasOne(Compare::class, 'product_id', 'id')->where('user_id', Auth()->user()->id);
        } else {
            return $this->hasOne(SessionCompare::class, 'product_id', 'id')->where('session_id', Session::getId());
        }
    }


}
