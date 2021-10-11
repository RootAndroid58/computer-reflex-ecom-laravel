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
    
        if (isset($data->products) && count(collect($data->products))) { 
            $data->products = Product::whereIn('id', collect($data->products)->toArray())->get();
        }
        return $data;
    }

    public function getStyleAttribute($val)
    {
        $data = unserialize($val);

        return $data;
    }
}
