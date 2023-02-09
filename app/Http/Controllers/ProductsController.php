<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\ProductMeasure;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;

class ProductsController extends Controller
{
    public function index()
    {
        return view('modules.products.index');
    }


    public function add()
    {
        $types = ProductType::orderBy('name')->get();
        $measures = ProductMeasure::orderBy('name')->get();
        $stores = Store::orderBy('is_principal', 'DESC')
            ->get(['code', 'name', 'id', 'is_principal'])
            ->transform(function($item) {
                $store = new \stdClass;
                $store->id = $item->id;
                $store->name = $item->name;
                $store->code = $item->code;
                $store->is_principal = $item->is_principal;
                $store->package_quantity = null;
                $store->quantity = null;

                return $store;
            });
        return view('modules.products.add', [
            'types' => $types,
            'measures' => $measures,
            'stores' => $stores
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        DB::beginTransaction();

        //Create product

        $product = Product::create([
            'status' => 1,
            'type_id' => $data['type_id'],
            'code' => $data['code'],
            'description' => $data['description'],
            'minimun_stock' => $data['minimum_stock'],
            'measure_id' => $data['measure_id'],
            'price_per_dozen' => $data['price_per_dozen'],
            'price_per_unit' => $data['price_per_unit'],
            'cost' => $data['cost']
        ]);


        //verify anda attach stores with stock
        if($data['add_stock'] == 1) {
            foreach($data['stores'] as $s) {
                $product->stores()->attach($s['id'], [
                    'quantity' => $s['quantity'],
                    'package_quantity' => $s['package_quantity'],
                    'quantity_sunat' => 0
                    ]);
            }
        }

        DB::commit();

        Toast::title('Exito!')
        ->center('El producto se ha guardao con éxito')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        session()->flash('status', 'Producto guardado exitosamente');
    }
}
