<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Tables\Products;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\ProductMeasure;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\Products\ProductSaveRequest;
use App\Http\Requests\Products\ProductUpdateRequest;

class ProductsController extends Controller
{
    public function index()
    {
        return view('modules.products.index', ['products' => Products::class]);
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

    public function edit(Product $product)
    {
        $types = ProductType::orderBy('name')->get();
        $measures = ProductMeasure::orderBy('name')->get();
        return view('modules.products.edit', [
            'types' => $types,
            'measures' => $measures,
            'product' => $product,

        ]);
    }

    public function update(Product $product, ProductUpdateRequest $request)
    {

        $product->forceFill([
            'cost' => $request->get('product')['cost'],
            'price' => $request->get('product')['price'],
            'minimun_stock' => $request->get('product')['minimun_stock'],
        ])->save();

        Toast::title('Exito!')
        ->center('El producto se ha actualizado con éxito')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('pr.index');
    }

    public function store(ProductSaveRequest $request)
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
            'price' => $data['price'],
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

    public function getStockTiendas(Product $product)
    {
        $stores = $product->stores->transform(function($store){
            $item = new \stdClass;
            $item->id = $store->id;
            $item->code = $store->code;
            $item->name = $store->name;
            $item->is_principal = $store->is_principal;
            $item->stock = number_format($store->pivot->quantity, 0, "",",");
            $item->stock_description = $store->pivot->package_quantity;

            return $item;
        });

        return view('modules.products.modals.stock-tiendas', ['product' => $product, 'stores' => $stores]);
    }
}
