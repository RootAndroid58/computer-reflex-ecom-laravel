<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HomeSectionProduct;

class HomeSection extends Model
{
    use HasFactory;

    public function SectionProducts()
    {
        return $this->hasMany(HomeSectionProduct::class, 'home_section_id', 'id');
    }
}
