<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::truncate();

        $modules = [
            [
                'id' => 'US',
                'name' => 'Usuarios',
                'description' => 'Modulo para gestionar usuarios',
                'route' => '/usuarios',
                'permission_to_access' => 'us:access'
            ],
            // [
            //     'id' => 'CF',
            //     'name' => 'Configuración',
            //     'description' => 'Configuración del sistema',
            //     'route' => '/configuracion',
            //     'permission_to_access' => 'cf:access'
            // ],
            [
                'id' => 'TI',
                'name' => 'Tiendas',
                'description' => 'Lista de tiendas',
                'route' => '/tiendas',
                'permission_to_access' => 'ti:access'
            ],
            // [
            //     'id' => 'VE',
            //     'name' => 'Ventas',
            //     'description' => 'Modulo de Ventas',
            //     'route' => '/ventas',
            //     'permission_to_access' => 've:access'
            // ],
            [
                 'id' => 'PR',
                 'name' => 'Productos',
                 'description' => 'Catalogo de productos',
                 'route' => '/productos',
                 'permission_to_access' => 'pr:access'
            ],
            // [
            //     'id' => 'IN',
            //     'name' => 'Inventario',
            //     'description' => 'Stock de productos',
            //     'route' => '/inventario',
            //     'permission_to_access' => 'in:access'
            // ],
            // [
            //     'id' => 'PV',
            //     'name' => 'Proveedores',
            //     'description' => 'Catalago de Proveedores',
            //     'route' => '/proveedores',
            //     'permission_to_access' => 'pv:access'
            // ],
            // [
            //     'id' => 'CO',
            //     'name' => 'Compras',
            //     'description' => 'Compras de materia prima',
            //     'route' => '/proveedores',
            //     'permission_to_access' => 'pv:access'
            // ],
        ];

        Module::insert($modules);


    }
}
