<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
            'dni' => '002683688',
            'username' => 'superadmin',
            'name' => 'Super Administrador',
            'email' => 'superadmin@local.com',
            'password' => bcrypt('laravel')
        ]);

        $super_admin->assignRole('super-admin');

        $super_admin->givePermissionTo(Permission::all()->pluck('name'));


        $admin = User::create([
            'dni' => '19098518',
            'username' => 'admin',
            'name' => 'Administrador',
            'email' => 'admin@local.com',
            'password' => bcrypt('laravel')
        ]);

        $admin->assignRole('admin');

        $admin->givePermissionTo(Permission::where('module_id', 'US')->get()->pluck('name'));


        $operator = User::create([
            'dni' => '19098517',
            'username' => 'operador',
            'name' => 'Operador',
            'email' => 'operator@local.com',
            'password' => bcrypt('laravel')
        ]);

        $operator->assignRole('operator');



    }
}
