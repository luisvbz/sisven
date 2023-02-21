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
use Illuminate\Support\Facades\Validator;
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
        return view('modules.products.add', [
            'types' => $types,
            'measures' => $measures,
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


        DB::commit();

        Toast::title('Exito!')
        ->center('El producto se ha guardao con éxito')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        session()->flash('status', 'Producto guardado exitosamente');

        return redirect()->route('pr.index');
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
                        ->paginate(10)
        ]);
    }

    public function addTypes()
    {
        return view('modules.products.types.add', [
            'packages' => ProductPackage::all()
        ]);
    }

    public function editType(ProductType $type)
    {
        return view('modules.products.types.edit', [
            'packages' => ProductPackage::all(),
            'type' => $type
        ]);
    }

    public function updateType(ProductType $type, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'package_id' => 'required',
        ],[
            'name.required' => 'Ingrese el nombre',
            'package_id.required' => 'Seleccione la presentación',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pr.edit-type', [$type])
                        ->withErrors($validator)
                        ->withInput();
        }

        if(Product::where('type_id', $type->id)->exists())
        {
            Toast::title('Adevertencia!')
            ->center('Existe productos con este tipo registrado, al actualizar el nombre cambiará en todos los registrsos. Para hacer necesitas un permiso especial')
            ->warning()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pr.index-types');
        }

        $type->forceFill([
            'name' => Str::upper($request->name),
            'alias' => Str::slug($request->name),
            'package_id' => $request->package_id,

        ])->save();

        Toast::title('Exito!')
        ->center('El producto se ha actualizado satisfactoriamente')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('pr.index-types');
    }

    public function storeType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'package_id' => 'required',
        ],[
            'name.required' => 'Ingrese el nombre',
            'package_id.required' => 'Seleccione la presentación',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pr.add-types')
                        ->withErrors($validator)
                        ->withInput();
        }

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
            $message = $e->getCode() == '23000'
                        ? 'No se puede eliminar el tipo de producto porque ya está enlazado a uno o varios productos'
                        : $e->getMessage();

            Toast::title('Error!')
            ->center($message)
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

    public function getMeasures()
    {
        return view('modules.products.measures.index',
        [
            'measures' => SpladeTable::for(ProductMeasure::class)
                        ->withGlobalSearch(columns: ['name'])
                        ->column(key: 'name', label: 'Nombre')
                        ->column(key: 'alias', label: 'Alias')
                        ->column('acciones')
                        ->paginate(10)
        ]);
    }

    public function addMeasures()
    {
        return view('modules.products.measures.add');
    }

    public function editMeasure(ProductMeasure $measure)
    {
        return view('modules.products.measures.edit', [
            'measure' => $measure
        ]);
    }

    public function updateMeasure(ProductMeasure $measure, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'alias' => 'required',
        ],[
            'name.required' => 'Ingrese el nombre',
            'alias.required' => 'El alias',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pr.edit-measure', [$measure])
                        ->withErrors($validator)
                        ->withInput();
        }

        if(Product::where('measure_id', $measure->id)->exists())
        {
            Toast::title('Adevertencia!')
            ->center('Existe productos con este tipo de unidad de medida, al actualizar el nombre cambiará en todos los registrsos. Para hacer necesitas un permiso especial')
            ->warning()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pr.index-types');
        }

        $measure->forceFill([
            'name' => Str::upper($request->name),
            'alias' => $request->alias,

        ])->save();

        Toast::title('Exito!')
        ->center('La unidad de medida se ha actualizado satisfactoriamente')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('pr.index-types');
    }

    public function storeMeasure(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'alias' => 'required',
        ],[
            'name.required' => 'Ingrese el nombre',
            'alias.required' => 'El alias',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pr.add-measures')
                        ->withErrors($validator)
                        ->withInput();
        }

        ProductMeasure::create([
            'name' => Str::upper($request->name),
            'alias' => $request->name,
        ]);

        Toast::title('Exito!')
        ->center('¡La unidad de medida se ha guardado exitosamente!')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('pr.index-measures');
    }

    public function deleteMeasure(ProductMeasure $measure)
    {
        try{
            $measure->delete();

            Toast::title('Exito!')
            ->center('La unidad de medida se ha eliminado satisfactoriamente')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pr.index-measures');

        }catch(QueryException $e) {
            $message = $e->getCode() == '23000'
                        ? 'No se puede eliminarla unidad de medida porque ya está enlazado a uno o varios productos'
                        : $e->getMessage();

            Toast::title('Error!')
            ->center($message)
            ->danger()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pr.index-measures');
        }catch(\Exception $e) {
            Toast::title('Error!')
            ->center($e->getMessage())
            ->danger()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pr.index-measures');
        }

    }
}
