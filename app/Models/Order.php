<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\OrderAddress;

class Order extends Model
{
    use HasFactory;

    // public function Products()
    // {
    //     return $this->hasMany(Product::class, 'id', 'product_id');
    // }

    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function Address()
    {
        return $this->hasOne(OrderAddress::class, 'id', 'address_id');
    }
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
