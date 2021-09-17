<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DefaultUsersSeeder::class,
            ModelHasPermissionsSeeder::class,
            DefaultPermissionsSeeder::class,
            SmallBannerSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            DefaultSystemSettingSeeder::class,
        ]);
    }
}
