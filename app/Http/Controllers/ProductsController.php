<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Tables\Products;
use App\Models\ProductType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductMeasure;
use App\Models\ProductPackage;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Database\QueryException;
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


    public function getTypes()
    {
        return view('modules.products.types.index',
        [
            'types' => SpladeTable::for(ProductType::class)
                        ->withGlobalSearch(columns: ['name'])
                        ->column(key: 'name', label: 'Nombre')
                        ->column(key: 'package.name', label: 'Tipo de presentación')
                        ->column('acciones')
                        ->paginate(30)
        ]);
    }

    public function addTypes()
    {
        return view('modules.products.types.add', [
            'packages' => ProductPackage::all()
        ]);
    }

    public function storeType(Request $request)
    {
        ProductType::create([
            'name' => Str::upper($request->name),
            'alias' => Str::slug($request->name),
            'category' => 'docena',
            'package_id' => $request->package_id
        ]);

        Toast::title('Exito!')
        ->center('El producto se ha eliminado satisfactoriamente')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('pr.index-types');
    }

    public function deleteType(ProductType $type)
    {
        try{
            $type->delete();

            Toast::title('Exito!')
            ->center('El producto se ha eliminado satisfactoriamente')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pr.index-types');

        }catch(QueryException $e) {
            $message = $e->getCode() == 23000
                        ? 'No se puede eliminar el tipo de producto porque ya está enlazado a uno o varios productos'
                        : $e->getMessage();

            Toast::title('Error!')
            ->center($e->getCode())
            ->danger()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pr.index-types');
        }catch(\Exception $e) {
            Toast::title('Error!')
            ->center($e->getMessage())
            ->danger()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pr.index-types');
        }

    }
}
