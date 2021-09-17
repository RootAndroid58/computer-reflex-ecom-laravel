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
            DefaultSystemSettingSeeder::class,
            ModelHasPermissionsSeeder::class,
            DefaultPermissionsSeeder::class,
            DefaultUsersSeeder::class,
            SmallBannerSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
        ]);
    }
}
