<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateOrderItem extends Model
{
    use HasFactory;

    public function OrderItem()
    {
        return $this->hasOne(OrderItem::class, 'id', 'order_item_id')->orderBy('id', 'desc');
    }
}
