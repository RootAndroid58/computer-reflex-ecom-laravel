<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Product;

class HomeSection extends Model
{
    use HasFactory;

    public function getProductsAttribute($val)
    {
        return Product::whereIn('id', unserialize($val))->get();
    }
}
