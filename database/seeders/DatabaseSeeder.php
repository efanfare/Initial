<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            PackagesTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CountriesTableSeeder::class,
            SceneTableSeeder::class,
            BackgroundTableSeeder::class,
        ]);
    }
}
