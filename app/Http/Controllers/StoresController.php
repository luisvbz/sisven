<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Tables\Stores;
use App\Models\Departament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\Stores\StoreSaveRequest;

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


    public function delete(Store $store)
    {
        $store->delete();

        Toast::title('Exito!')
        ->center('La tienda se ha eliminado satisfactoriamente')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('ti.index');
    }
}
