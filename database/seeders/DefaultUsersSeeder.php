<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'                => 1,
                'name'              => 'Master Admin',
                'email'             => 'admin@computerreflex.tk',
                'mobile'            => '8902984277',
                'password'          => bcrypt('Password1234'),
                'status'            => 'active',
                'email_verified_at' => date('y-m-d h:m:s'),
                'created_at'        => date('y-m-d h:m:s'),
                'dp'                => 'default.png',
            ],
        ];

        User::insert($users);
    }
}
