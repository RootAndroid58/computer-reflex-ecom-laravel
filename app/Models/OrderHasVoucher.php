<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Voucher;

class OrderHasVoucher extends Model
{
    use HasFactory;

    public function voucher()
    {
        return $this->hasOne(Voucher::class, 'id', 'voucher_id');
    }
}
