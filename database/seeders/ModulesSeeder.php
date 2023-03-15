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
            [
                 'id' => 'VE',
                 'name' => 'Ventas',
                 'description' => 'Modulo de Ventas',
                 'route' => '/ventas',
                 'permission_to_access' => 've:access'
            ],
            [
                 'id' => 'PR',
                 'name' => 'Productos',
                 'description' => 'Catalogo de productos',
                 'route' => '/productos',
                 'permission_to_access' => 'pr:access'
            ],
            [
                 'id' => 'WR',
                 'name' => 'Almacen',
                 'description' => 'Manejo de almacenes',
                 'route' => '/almacenes',
                 'permission_to_access' => 'wr:access'
            ],
            [
                 'id' => 'PV',
                 'name' => 'Proveedores',
                 'description' => 'Catalago de Proveedores',
                 'route' => '/proveedores',
                 'permission_to_access' => 'pv:access'
             ],
            [
                 'id' => 'CO',
                 'name' => 'Compras',
                 'description' => 'Compras de materia prima',
                 'route' => '/compras',
                 'permission_to_access' => 'co:access'
            ],
            [
                'id' => 'RP',
                'name' => 'Reportes',
                'description' => 'Modulo de reportes',
                'route' => '/reportes',
                'permission_to_access' => 'rp:access'
            ],
            [
                'id' => 'CL',
                'name' => 'Clientes',
                'description' => 'Modulo de clientes',
                'route' => '/clientes',
                'permission_to_access' => 'cl:access'
            ],
            [
                'id' => 'DE',
                'name' => 'Documentos',
                'description' => 'Facturas / Boletas / Notas',
                'route' => '/clientes',
                'permission_to_access' => 'de:access'
            ],
        ];

        Module::insert($modules);


    }
}
