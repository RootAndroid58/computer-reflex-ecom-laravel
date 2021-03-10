<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;

class Wishlist extends Model
{
    use HasFactory;

    public function Cart()
    {
        return $this->hasOne(Cart::class, 'product_id', 'product_id');
    }

    public function Products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function Images()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'product_id')->orderBy('id', 'desc');
    }
}
