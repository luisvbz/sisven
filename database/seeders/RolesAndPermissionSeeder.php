<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Basic roles for any aplicaction

        $superAdmin = Role::create(['name' => 'super-admin', 'display_name' => 'Super Admin']);
        $admin = Role::create(['name' => 'admin', 'display_name' => 'Administrador del Sistema']);
        $operator = Role::create(['name' => 'operator', 'display_name' => 'Operador']);

         //Here to create permissions

         //Permissions
         $permissions_users = [
            //Modulo de usuarios
            'us:access',
            'us:create',
            'us:edit',
            'us:delete',
            'us:activate',
            'us:desactivate',
         ];

         foreach($permissions_users as $pu) {

             Permission::create(['name' => $pu]);
         }


         //Asing permission to users admin
         $admin->syncPermissions(Permission::where('name', 'like', "us:%")->get()->pluck('name'));
    }
}
