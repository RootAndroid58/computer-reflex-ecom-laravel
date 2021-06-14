<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemLicense extends Model
{
    use HasFactory;

    public function ProductLicense()
    {
        return $this->hasOne(ProductLicense::class, 'id', 'product_license_id')->orderBy('id', 'desc');
    }

    public function affiliate()
    {
        return $this->hasOne(Affiliate::class, 'user_id', 'id')->orderBy('id', 'desc');
    }

}
