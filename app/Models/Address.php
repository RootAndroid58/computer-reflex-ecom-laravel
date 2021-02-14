<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'house_no',
        'locality',
        'city',
        'district',
        'state',
        'pin_code',
        'mobile',
        'alt_mobile',
    ];
}
