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
            ]
        ];

        Module::insert($modules);


    }
}
