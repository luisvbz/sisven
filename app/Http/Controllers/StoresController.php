<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Tables\Stores;
use App\Models\Departament;
use Illuminate\Http\Request;
use App\Models\StoreMovement;
use App\Tables\StoresMovements;
use App\Tables\StoreStockTable;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\Stores\StoreSaveRequest;
use App\Http\Requests\Stores\StoreUpdateRequest;

class StoresController extends Controller
{
    public function index(Request $request)
    {
        return view('modules.stores.index', ['stores' => Stores::class]);
    }

    public function add(Request $request)
    {
        return view('modules.stores.add', [
            'departaments' =>  Splade::onInit(fn () => Departament::all()),
        ]);
    }

    public function edit(Store $store)
    {
        return view('modules.stores.edit', [
            'store' => $store,
            'departaments' =>  Splade::onInit(fn () => Departament::all()),
        ]);
    }

    public function store(StoreSaveRequest $request)
    {
        try {

             DB::beginTransaction();

             Store::create($request->all());

             DB::commit();

             Toast::title('Exito!')
             ->center('La tienda se ha creado satisfactoriamente')
             ->success()
             ->backdrop()
             ->autoDismiss(15);

             return redirect()->route('ti.index');


         }catch(\Exception $e) {
             Toast::center('Error!')
             ->message($e->getMessage())
             ->backdrop()
             ->danger();

             return redirect()->route('ti.index');
         }
    }

    public function update(Store $store, StoreUpdateRequest $request)
    {
        try {

            DB::beginTransaction();

            $store->fill($request->all())->save();

            DB::commit();

            Toast::title('Exito!')
            ->center('La tienda se ha actualizado satisfactoriamente')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('ti.index');


        }catch(\Exception $e) {
            Toast::center('Error!')
            ->message($e->getMessage())
            ->backdrop()
            ->danger();

            return redirect()->route('ti.index');
        }
    }


    public function delete(Store $store)
    {

        if(count($store->products) > 0) {
            Toast::title('Exito!')
            ->center('Existen productos asociados a la tienda, no se puede eliminar')
            ->danger()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('ti.index');
        }

        $store->delete();

        Toast::title('Exito!')
        ->center('La tienda se ha eliminado satisfactoriamente')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('ti.index');
    }

    public function movements(Store $store)
    {
        $movements_table = new StoresMovements($store->id);
        return view('modules.stores.movements', [
            'store' => $store,
            'movements' => $movements_table
        ]);
    }

    public function movementsDetails(Store $store, StoreMovement $movement) {
        return view('modules.stores.movement-details', [
            'movement' => $movement
        ]);
    }

    public function stock(Store $store)
    {
        $stock_table = new StoreStockTable($store);
        return view('modules.stores.stock', [
            'store' => $store,
            'stock' => $stock_table
        ]);
    }
}
