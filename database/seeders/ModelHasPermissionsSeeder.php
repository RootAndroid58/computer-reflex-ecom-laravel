<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ModelHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('id' ,'1')->first()->givePermissionTo('Master Admin');
        User::where('id' ,'1')->first()->givePermissionTo('Admin');
    }
}
