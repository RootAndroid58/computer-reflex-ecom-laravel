<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CatalogProduct;

class Catalog extends Model
{
    use HasFactory;

    public function CatalogProducts()
    {
        return $this->hasMany(CatalogProduct::class, 'catalog_id', 'id');
    }
}
