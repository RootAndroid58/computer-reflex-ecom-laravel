<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(VoucherProduct::class, 'product_id', 'product_id');
    }
}
