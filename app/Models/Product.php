<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Compare;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\SessionCart;
use App\Models\ProductImage;
use App\Models\Specification;
use Laravel\Scout\Searchable;
use App\Models\SessionCompare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\JsonDecoder;

class Product extends Model
{
    
    use HasFactory, Searchable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['category', 'specifications', 'images', 'avgStars', 'userStars'];

    protected $guarded = [];

    public function getCategoryAttribute()
    {
        return $this->attributes['category'] = Category::where('id', $this->product_category_id)->first()->category;
    }

    public function getTagsAttribute($val)
    {
        if (is_array($val)) {
            $data = $val;
        } else {
            $data = unserialize($val);
        }
        
        return $this->attributes['tags'] = json_decode(json_encode($data));
    }

    public function getSpecificationsAttribute()
    {
        return $this->attributes['specifications'] = Specification::where('product_id', $this->id)->get();
    }

    // Avg stars of the product (All Users)
    public function getAvgStarsAttribute()
    {
        $reviews = ProductReview::where('product_id', $this->id)->get();
        $starsArr = $reviews->pluck('stars')->toArray();
        $avgStars = 0;
        if (count($starsArr)) {
            $avgStars = floorToFraction(array_sum($starsArr) / count($starsArr), 2);
        }
        return $this->attributes['avgStars'] = $avgStars;
    }

    // Stars given by the logged in user.
    public function getUserStarsAttribute()
    {
        $review = ProductReview::where('product_id', $this->id)->where('user_id', Auth()->user()->id)->first();
        $userStars = null;
        if (isset($review->stars)) {
            $userStars = $review->stars;
        }
        return $this->attributes['userStars'] = $userStars;
    }

    public function getImagesAttribute()
    {
        return $this->attributes['images'] = ProductImage::where('product_id', $this->id)->get();
    }
    
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
