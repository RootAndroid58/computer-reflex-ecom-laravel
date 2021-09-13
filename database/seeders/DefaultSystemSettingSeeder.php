<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\SystemSetting;

class DefaultSystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'id'    => 1,
                'key'   => 'PaytmCheckout',
                'value' => 'active',
            ],
            [
                'id'    => 2,
                'key'   => 'PayuCheckout',
                'value' => 'inactive',
            ],
            [
                'id'    => 3,
                'key'   => 'CODCheckout',
                'value' => 'active',
            ],
            [
                'id'    => 4,
                'key'   => 'AssetCache',
                'value' => 1,
            ],
        ];

        SystemSetting::insert($settings);
    }
}
