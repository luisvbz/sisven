<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\ProductType;
use App\Models\ProductMeasure;
use App\Models\ProductPackage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Add atores

        Store::insert([
            [
                'code' => 'TI-001',
                'name' => 'Tienda de Lince',
                'is_principal' => true,
                'departament_id' => '15',
                'province_id' => '1501',
                'district_id' => '150116',
                'address' => 'Av. Jose Galvez 1479',
                'phone_number' => '912575368'
            ],
            [
                'code' => 'TI-002',
                'name' => 'Tienda de Jesus Maria',
                'is_principal' => false,
                'departament_id' => '15',
                'province_id' => '1501',
                'district_id' => '150144',
                'address' => 'Av. Jose Galvez 1479',
                'phone_number' => '912575368'
           ],

        ]);

        //Add Product Packages
        ProductPackage::insert([
            ['name' => 'Bolsas', 'alias' => 'bolsas'],
            ['name' => 'Planchas', 'alias' => 'planchas']
        ]);

        //
        ProductType::insert([
            [
              'name' => 'ADORNOS DE METAL',
              'alias' => 'adornos-de-metal',
              'category' => 'docena',
              'package_id' => 1,
            ],
            [
                'name' => 'HEBILLAS',
                'alias' => 'hebillas',
                'category' => 'docena',
                'package_id' => 1,
            ],
            [
                'name' => 'SHAKIRAS',
                'alias' => 'shakiras',
                'category' => 'docena',
                'package_id' => 1,
            ]

        ]);

        ProductMeasure::insert([
            ['name' => 'Pares', 'alias' => 'pares'],
            ['name' => 'Galones', 'alias' => 'gl'],
            ['name' => 'Latas', 'alias' => 'latas'],
            ['name' => 'Metros', 'alias' => 'mts'],
            ['name' => 'Listros', 'alias' => 'lts'],
            ['name' => 'Rollo', 'alias' => 'rollo'],
        ]);

    }
}
