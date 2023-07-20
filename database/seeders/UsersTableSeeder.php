<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'           => 'Admin',
                'first_name'     => '',
                'last_name'      => '',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'two_factor' => 0,
                'package_id' => 1,
                'package_interval' => 'monthly'
            ],
            [
                'name'           => 'Rafi',
                'first_name'     => 'Rafi',
                'last_name'      => 'Ullah',
                'email'          => 'rafi@mailinator.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'two_factor' => 0,
                'package_id' => 1,
                'package_interval' => 'monthly'

            ],
            [
                'name'           => 'Farhan',
                'first_name'     => 'Farhan',
                'last_name'      => 'Khan',
                'email'          => 'farhan@mailinator.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'two_factor' => 0,
                'package_id' => 2,
                'package_interval' => 'yearly'
            ],
            [
                'name'           => 'John',
                'first_name'     => 'John',
                'last_name'      => 'Doe',
                'email'          => 'john@mailinator.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'two_factor' => 0,
                'package_id' => 3,
                'package_interval' => 'monthly'
            ],
        ];

        User::insert($users);
    }
}
