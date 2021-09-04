<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\OrderAddress;
use App\Models\ReturnOrder;


class Order extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    public $incrementing = false;


    
 

    // public function Products()
    // {
    //     return $this->hasMany(Product::class, 'id', 'product_id');
    // }

    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function ReturnOrders()
    {
        return $this->hasMany(ReturnOrder::class, 'order_id', 'id');
    }
    public function Address()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id');
    }
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function ForwardShipment()
    {
        return $this->hasOne(Shipment::class, 'order_id', 'id')->where('type', 'forward');
    }
    public function CancelRequest()
    {
        return $this->hasMany(OrderCancelRequest::class, 'order_id', 'id')
        ;
    }
    public function PendingCancelRequest()
    {
        return $this->hasOne(OrderCancelRequest::class, 'order_id', 'id')->where('status', 'requested');
    }
    // public function voucher()
    // {
    //     return $this->hasOne(OrderHasVoucher::class, 'order_id', 'id')->where('status', 'requested');
    // }

}
