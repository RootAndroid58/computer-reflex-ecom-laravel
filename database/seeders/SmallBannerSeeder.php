<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\SmallBanner;

class SmallBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SmallBanners = [
            [
                'id'                    => 1,
                'image'                 => 'dummy',
                'link'                  => url('/'),
            ],
            [
                'id'                    => 2,
                'image'                 => 'dummy',
                'link'                  => url('/'),
            ],
            [
                'id'                    => 3,
                'image'                 => 'dummy',
                'link'                  => url('/'),
            ],
            [
                'id'                    => 4,
                'image'                 => 'dummy',
                'link'                  => url('/'),
            ],
            [
                'id'                    => 5,
                'image'                 => 'dummy',
                'link'                  => url('/'),
            ],
        ];
        SmallBanner::insert($SmallBanners);
    }
}
