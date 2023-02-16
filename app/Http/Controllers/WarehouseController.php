<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Tables\Warehouses;
use App\Models\Departament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\Warehouse\WarehouseSaveRequest;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.warehouses.index', ['warehouses' => Warehouses::class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.warehouses.add', [
            'departaments' =>  Splade::onInit(fn () => Departament::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseSaveRequest $request)
    {
        try {

            DB::beginTransaction();

            Warehouse::create($request->all());

            DB::commit();

            Toast::title('Exito!')
            ->center('El almacen se ha creado satisfactoriamente')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('wr.index');


        }catch(\Exception $e) {
            Toast::center('Error!')
            ->message($e->getMessage())
            ->backdrop()
            ->danger();

            return redirect()->route('wr.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return view('modules.warehouses.edit', [
            'warehouse' => $warehouse,
            'departaments' =>  Splade::onInit(fn () => Departament::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Warehouse $warehouse, WarehouseSaveRequest $request)
    {
        try {

            DB::beginTransaction();

            $warehouse->forceFill($request->except('_method'))->save();

            DB::commit();

            Toast::title('Exito!')
            ->center('El almacen se ha actualizado satisfactoriamente')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('wr.index');


        }catch(\Exception $e) {
            Toast::center('Error!')
            ->message($e->getMessage())
            ->backdrop()
            ->danger();

            return redirect()->route('wr.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}