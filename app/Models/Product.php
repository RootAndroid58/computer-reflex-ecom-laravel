<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Category;
use App\Models\Specification;

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
            'products.product_brand' => 10,
            'products.product_description' => 3,
            'products.product_long_description' => 2,
            'products.product_price' => 7,
            'categories.category' => 10,
            'product_tags.product_tag' => 9,
        ],
        'joins' => [
            'categories'  => ['categories.id','products.product_category_id'],
            'product_tags'      => ['product_tags.product_id', 'products.id'],
        ],
    ];


    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function stars()
    {
        return $this->hasOne(ProductReview::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function tags()
    {
        return $this->hasMany(ProductTag::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'product_category_id')->orderBy('id', 'desc');
    }
    public function comission()
    {
        return $this->hasOne(ProductComission::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function specifications()
    {
        return $this->hasMany(Specification::class, 'product_id', 'id');
    }
}
