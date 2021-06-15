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
    public function OrderItemLicenses()
    {
        return $this->hasMany(OrderItemLicense::class, 'order_item_id', 'id');
    }
    public function image()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'product_id')->orderBy('id', 'desc');
    }
    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'order_item_id', 'id')->orderBy('id', 'desc');
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
    public function AffiliateOrderItem()
    {
        return $this->hasOne(AffiliateOrderItem::class, 'order_item_id', 'id');
    }

}
