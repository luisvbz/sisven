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
            ['name' => 'us:edit', 'guard_name' => 'web', 'display_name' => 'Editar un usuario', 'module_id' => 'US'],
            ['name' => 'us:delete', 'guard_name' => 'web', 'display_name' => 'Eliminar un usuario', 'module_id' => 'US'],
            ['name' => 'us:activate', 'guard_name' => 'web', 'display_name' => 'Activar un usuario', 'module_id' => 'US'],
            ['name' => 'us:desactivate', 'guard_name' => 'web', 'display_name' => 'Desactivar un usuario', 'module_id' => 'US'],
            ['name' => 'us:show-deleted', 'guard_name' => 'web', 'display_name' => 'Ver usuarios eliminados', 'module_id' => 'US'],
            //Mdoulo de tienda
            ['name' => 'ti:access', 'guard_name' => 'web', 'display_name' => 'Acceder al modulo de tiendas', 'module_id' => 'TI'],
            ['name' => 'ti:create', 'guard_name' => 'web', 'display_name' => 'Crear un nueva tienda', 'module_id' => 'TI'],
            ['name' => 'ti:edit', 'guard_name' => 'web', 'display_name' => 'Editar una tienda', 'module_id' => 'TI'],
            ['name' => 'ti:delete', 'guard_name' => 'web', 'display_name' => 'Eliminar una tienda', 'module_id' => 'TI'],
            ['name' => 'ti:show-deleted', 'guard_name' => 'web', 'display_name' => 'Ver tiendas eliminadas', 'module_id' => 'TI'],
            //Mdoulo de productos
            ['name' => 'pr:access', 'guard_name' => 'web', 'display_name' => 'Acceder al modulo de productos', 'module_id' => 'PR'],
            ['name' => 'pr:create', 'guard_name' => 'web', 'display_name' => 'Agregar un nuevo producto', 'module_id' => 'PR'],
            ['name' => 'pr:edit', 'guard_name' => 'web', 'display_name' => 'Editar producto', 'module_id' => 'PR'],
            ['name' => 'pr:delete', 'guard_name' => 'web', 'display_name' => 'Eliminar producto', 'module_id' => 'PR'],
         ];

         Permission::insert($permissions);

         //Asing permission to users admin
         //$admin->syncPermissions(Permission::where('name', 'like', "ti:%")->get()->pluck('name'));
    }
}
