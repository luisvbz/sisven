<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Tables\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\Suppliers\CreateSupplierRequest;
use App\Http\Requests\Suppliers\UpdateSupplierRequest;

class SuplliersController extends Controller
{
    public function index()
    {
        return view('modules.suppliers.index', [
            'suppliers' => Suppliers::class
        ]);
    }

    public function create()
    {
        return view('modules.suppliers.add');
    }

    public function store(CreateSupplierRequest $request)
    {
        try {

            DB::beginTransaction();

            Supplier::create($request->all());

            DB::commit();

            Toast::title('Exito!')
            ->center('El proveedor se ha creado satisfactoriamente')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pv.index');


        }catch(\Exception $e) {
            Toast::center('Error!')
            ->message($e->getMessage())
            ->backdrop()
            ->danger();

            return redirect()->route('pv.index');
        }
    }

    public function edit(Supplier $supplier)
    {
        return view('modules.suppliers.edit', ['supplier' => $supplier]);
    }

    public function update(Supplier $supplier, UpdateSupplierRequest $request)
    {
        try {

            DB::beginTransaction();

            $supplier->forceFill([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            ])->save();

            DB::commit();

            Toast::title('Exito!')
            ->center('El proveedor se ha actualizado satisfactoriamente')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('pv.index');


        }catch(\Exception $e) {
            Toast::center('Error!')
            ->message($e->getMessage())
            ->backdrop()
            ->danger();

            return redirect()->route('pv.index');
        }
    }
}
