<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\ProductTag;

class Product extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
    public function tags()
    {
        return $this->hasMany(ProductTag::class, 'product_id', 'id')->orderBy('id', 'desc');
    }
}
