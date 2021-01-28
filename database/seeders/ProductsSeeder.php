<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id'                    => 1,
                'product_name'          => 'G.SKILL Trident Z 16GB (2 x 8GB) DDR4 3200Mhz RGB Series Memory - F43200C16D16GTZR',
                'product_brand'         => 'G.SKILL',
                'product_mrp'           => '35799',
                'product_price'         => '10599',
                'product_published'     => 0,
                'product_category_id'   => 7,
                'product_stock'         => 0,
                'product_description'   => 'Not Mentioned',
                'created_at'            => date('y-m-d h:m:s'),
            ],
            [
                'id'                    => 2,
                'product_name'          => 'Zotac GeForce GTX 1050 Ti OC Edition ZT-P10510B-10L 4GB PCI Express Graphics Card',
                'product_brand'         => 'Zotac',
                'product_mrp'           => '17980',
                'product_price'         => '14899',
                'product_published'     => 0,
                'product_category_id'   => 5,
                'product_stock'         => 0,
                'product_description'   => 'Not Mentioned',
                'created_at'            => date('y-m-d h:m:s'),
            ],
        ];

        Product::insert($products);
    }
}
