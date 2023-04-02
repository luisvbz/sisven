<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            UbigeoSeeders::class,
            ModulesSeeder::class,
            ProductStoreSeeder::class,
            RolesAndPermissionSeeder::class,
           // UsersDefaultSeeder::class,
        ]);
    }
}
