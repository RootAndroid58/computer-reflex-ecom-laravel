<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id'            => 1,
                'category'      => 'Desktop',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 2,
                'category'      => 'Laptop',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 3,
                'category'      => 'Cabinet',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 4,
                'category'      => 'Motherboard',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 5,
                'category'      => 'Graphics Card',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 6,
                'category'      => 'Processor',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 7,
                'category'      => 'RAM',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 8,
                'category'      => 'Power Supply',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 9,
                'category'      => 'Cooler',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 10,
                'category'      => 'CPU Fan',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 11,
                'category'      => 'Mouse',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 12,
                'category'      => 'Mouse Pad',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 13,
                'category'      => 'Keyboard',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 14,
                'category'      => 'Keyboard Palm Rest',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 15,
                'category'      => 'Monitor',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 16,
                'category'      => 'Hard Disk',
                'created_at'    => date('y-m-d h:m:s'),
            ],
            [
                'id'            => 17,
                'category'      => 'SSD',
                'created_at'    => date('y-m-d h:m:s'),
            ],
        ];

        Category::insert($categories);
    }
}
