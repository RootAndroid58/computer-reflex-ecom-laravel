<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;


    protected $fillable = [
        'exp_date',
        'status',
    ];


    public function products()
    {
        return $this->hasMany(VoucherProduct::class, 'voucher_id', 'id');
    }
}
