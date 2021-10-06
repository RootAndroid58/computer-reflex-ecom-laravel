<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'data', 'position', 'visible', 'style'
    ];

    public function getDataAttribute($val)
    {
        $data = unserialize($val);
        
        if (isset($data->products) && count($data->products) > 0) {
            $data->products = Product::whereIn('id', $val->products)->get();
        }

        return $data;
    }
}
