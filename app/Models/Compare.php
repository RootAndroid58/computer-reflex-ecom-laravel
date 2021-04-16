<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Compare extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->orderBy('id', 'desc');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->orderBy('id', 'desc');
    }
}
