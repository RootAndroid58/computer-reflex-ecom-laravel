<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    public function Products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id')->where('product_status', 1);
    }
    
    public function CheckoutProducts()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->where('product_status', 1);
    }

    public function Images()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'product_id')->orderBy('id', 'desc');
    }
}
