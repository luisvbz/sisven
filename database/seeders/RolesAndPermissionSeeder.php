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
         $permissions = [
            //Modulo de usuarios
            ['name' => 'us:access', 'guard_name' => 'web', 'display_name' => 'Acceder al modulo de usuarios', 'module_id' => 'US'],
            ['name' => 'us:create', 'guard_name' => 'web', 'display_name' => 'Crear un nuevo usuarios', 'module_id' => 'US'],
            ['name' => 'us:edit', 'guard_name' => 'web', 'display_name' => 'Editar un nuevo usuario', 'module_id' => 'US'],
            ['name' => 'us:delete', 'guard_name' => 'web', 'display_name' => 'Eliminar un usuario', 'module_id' => 'US'],
            ['name' => 'us:activate', 'guard_name' => 'web', 'display_name' => 'Activar un usuarios', 'module_id' => 'US'],
            ['name' => 'us:desactivate', 'guard_name' => 'web', 'display_name' => 'Desactivar un usuarios', 'module_id' => 'US'],
         ];

         Permission::insert($permissions);

         //Asing permission to users admin
         //$admin->syncPermissions(Permission::where('name', 'like', "us:%")->get()->pluck('name'));
    }
}
