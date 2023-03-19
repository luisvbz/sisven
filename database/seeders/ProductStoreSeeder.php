<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Product;
use App\Models\SaleType;
use App\Models\Supplier;
use App\Models\InputType;
use App\Models\Warehouse;
use App\Models\OutputType;
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
                'name' => 'Tienda de Lince',
                'departament_id' => '15',
                'province_id' => '1501',
                'district_id' => '150116',
                'address' => 'Av. Jose Galvez 1479',
                'phone_number' => '912575368'
            ],
            [
                'name' => 'Tienda de Jesus Maria',
                'departament_id' => '15',
                'province_id' => '1501',
                'district_id' => '150144',
                'address' => 'Av. Jose Galvez 1479',
                'phone_number' => '912575368'
           ],
           [
                'name' => 'Tienda de Breña',
                'departament_id' => '15',
                'province_id' => '1501',
                'district_id' => '150144',
                'address' => 'Av. Jose Galvez 1479',
                'phone_number' => '912575368'
            ]

        ]);

        Warehouse::insert([
            [
                'name' => 'Almacen Cercado',
                'departament_id' => '15',
                'province_id' => '1501',
                'district_id' => '150116',
                'address' => 'Av. Jose Galvez 1479',
           ],
           [
                'name' => 'Almacen Breña',
                'departament_id' => '15',
                'province_id' => '1501',
                'district_id' => '150144',
                'address' => 'Av. Jose Galvez 1479',
            ]
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
              'package_id' => 1,
            ],
            [
                'name' => 'HEBILLAS',
                'alias' => 'hebillas',
                'package_id' => 1,
            ],
            [
                'name' => 'SHAKIRAS',
                'alias' => 'shakiras',
                'package_id' => 1,
            ]

        ]);

        ProductMeasure::insert([
            ['name' => 'Pares', 'alias' => 'pares'],
            ['name' => 'Galones', 'alias' => 'gl'],
            ['name' => 'Latas', 'alias' => 'latas'],
            ['name' => 'Metros', 'alias' => 'mts'],
            ['name' => 'Litros', 'alias' => 'lts'],
            ['name' => 'Rollo', 'alias' => 'rollo'],
        ]);


        InputType::insert([
            ['name' => 'Compra', 'alias' => 'compra'],
            ['name' => 'Manual', 'alias' => 'manual'],
            ['name' => 'Traslado', 'alias' => 'traslado'],
            ['name' => 'Venta Cancelada', 'alias' => 'venta-cancelada'],
        ]);

        OutputType::insert([
            ['name' => 'Traslado', 'alias' => 'traslado'],
            ['name' => 'Venta', 'alias' => 'venta'],
        ]);


        Product::factory()->count(50)->create();

        Supplier::create(
            [
              'name' => 'IMPORTADORA HOME CHINA S.A.C.',
              'ruc' => '20600473892',
              'phone_number' => '12345678',
              'address' => 'Jr. Lima 1312'
            ]
         );

        Supplier::create(
            [
                'name' => 'TIA CHINA S.A.C.',
                'ruc' => '20600699734',
                'phone_number' => '87654321',
                'address' => 'Jr. Lima 1522'
              ]);


        SaleType::insert([
            [
                'name' => 'Docena',
                'alias' => 'DOC',
                'quantity' => 12
            ],
            [
                'name' => 'Media Docena',
                'alias' => '1/2 DOC',
                'quantity' => 6
            ],
            [
                'name' => 'Un cuarto de Docena',
                'alias' => '1/4 DOC',
                'quantity' => 3
            ],
            [
                'name' => 'Unidad',
                'alias' => 'Unidad',
                'quantity' => 1
            ],
        ]);

    }
}
