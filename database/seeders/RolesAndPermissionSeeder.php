<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        $vendedor = Role::create(['name' => 'vendedor', 'display_name' => 'Vendedor']);

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
            //Mdoulo de Alamacen
            ['name' => 'wr:access', 'guard_name' => 'web', 'display_name' => 'Acceder al modulo de almacenes', 'module_id' => 'WR'],
            ['name' => 'wr:create', 'guard_name' => 'web', 'display_name' => 'Crear un nuevo almacen', 'module_id' => 'WR'],
            ['name' => 'wr:edit', 'guard_name' => 'web', 'display_name' => 'Editar un almacen', 'module_id' => 'WR'],
            ['name' => 'wr:delete', 'guard_name' => 'web', 'display_name' => 'Eliminar un almacen', 'module_id' => 'WR'],
            //Mdoulo de productos
            ['name' => 'pr:access', 'guard_name' => 'web', 'display_name' => 'Acceder al modulo de productos', 'module_id' => 'PR'],
            ['name' => 'pr:create', 'guard_name' => 'web', 'display_name' => 'Agregar un nuevo producto', 'module_id' => 'PR'],
            ['name' => 'pr:edit', 'guard_name' => 'web', 'display_name' => 'Editar producto', 'module_id' => 'PR'],
            ['name' => 'pr:delete', 'guard_name' => 'web', 'display_name' => 'Eliminar producto', 'module_id' => 'PR'],
            //Mdoulo de productos
            ['name' => 'pv:access', 'guard_name' => 'web', 'display_name' => 'Acceder al modulo de proveedores', 'module_id' => 'PV'],
            ['name' => 'pv:create', 'guard_name' => 'web', 'display_name' => 'Agregar un nuevo proveedores', 'module_id' => 'PV'],
            ['name' => 'pv:edit', 'guard_name' => 'web', 'display_name' => 'Editar proveedores', 'module_id' => 'PV'],
            ['name' => 'pv:delete', 'guard_name' => 'web', 'display_name' => 'Eliminar proveedores', 'module_id' => 'PV'],
            //Compras
            ['name' => 'co:access', 'guard_name' => 'web', 'display_name' => 'Acceder al modulo de compras', 'module_id' => 'CO'],
            ['name' => 'co:create', 'guard_name' => 'web', 'display_name' => 'Agregar un nuevo compras', 'module_id' => 'CO'],
            ['name' => 'co:edit', 'guard_name' => 'web', 'display_name' => 'Editar compras', 'module_id' => 'CO'],
            ['name' => 'co:delete', 'guard_name' => 'web', 'display_name' => 'Eliminar compras', 'module_id' => 'CO'],
            //Ventas
            ['name' => 've:access', 'guard_name' => 'web', 'display_name' => 'Acceder al modulo de ventas', 'module_id' => 'VE'],
            ['name' => 've:create', 'guard_name' => 'web', 'display_name' => 'Generar una nueva venta', 'module_id' => 'VE'],

         ];

         Permission::insert($permissions);

         //Asing permission to users admin
         //$admin->syncPermissions(Permission::where('name', 'like', "ti:%")->get()->pluck('name'));

         $super_admin = User::create([
            'dni' => '002683688',
            'username' => 'superadmin',
            'name' => 'Super Administrador',
            'email' => 'superadmin@local.com',
            'password' => 'laravel'
        ]);

        $super_admin->assignRole('super-admin');

        $super_admin->givePermissionTo(Permission::all()->pluck('name'));


        $admin = User::create([
            'dni' => '19098518',
            'username' => 'admin',
            'name' => 'Administrador',
            'email' => 'admin@local.com',
            'password' =>'laravel'
        ]);

        $admin->assignRole('admin');

       $admin->givePermissionTo(Permission::where('module_id', 'US')->get()->pluck('name'));


        $operator = User::create([
            'dni' => '19098517',
            'username' => 'operador',
            'name' => 'Operador',
            'email' => 'operator@local.com',
            'password' => 'laravel'
        ]);

        $operator->assignRole('operator');
    }
}
