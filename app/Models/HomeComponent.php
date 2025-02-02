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
        $data = json_decode($val);
    
        if (isset($data->products) && count(collect($data->products))) { 
            $data->products = Product::whereIn('id', collect($data->products)->toArray())->where('product_status', 1)->get();
        }
        return $data;
    }

    public function getStyleAttribute($val)
    {
        $data = json_decode($val);
        return $data;
    }
}
