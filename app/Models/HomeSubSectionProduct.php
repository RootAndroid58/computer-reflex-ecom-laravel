<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\HomeSubSection;


class HomeSubSectionProduct extends Model
{
    use HasFactory;

    protected $table = 'home_sub_section_products';        
    protected $primaryKey = 'id';

    public function Products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function HomeSubSection()
    {
        return $this->hasOne(HomeSubSection::class, 'id', 'home_sub_section_id');
    }
}
