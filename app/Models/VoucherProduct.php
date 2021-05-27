<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherProduct extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'voucher_id',
        'qty',
    ];
    
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }


}
