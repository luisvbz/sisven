<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Super Administrador',
            'email' => 'superadmin@local.com',
            'password' => bcrypt('laravel')
        ]);

        $super_admin->assignRole('super-admin');


        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'administrador@local.com',
            'password' => bcrypt('laravel')
        ]);

        $admin->assignRole('admin');


        $operator = User::create([
            'name' => 'operator',
            'email' => 'operator@local.com',
            'password' => bcrypt('laravel')
        ]);

        $operator->assignRole('operator');

    }
}
