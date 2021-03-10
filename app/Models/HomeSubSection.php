<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HomeSubSectionProduct;
use App\Models\HomeSection;

class HomeSubSection extends Model
{
    use HasFactory;

    protected $table = 'home_sub_sections';        
    protected $primaryKey = 'id';

    public function HomeSection()
    {
        return $this->hasOne(HomeSection::class, 'id', 'home_section_id');
    }
    public function SectionProducts()
    {
        return $this->hasMany(HomeSubSectionProduct::class, 'home_sub_section_id');
    }
}
