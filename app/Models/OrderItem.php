<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function image()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'product_id')->orderBy('id', 'desc');
    }
}
