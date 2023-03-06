<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Transfer;
use App\Models\InputType;
use App\Models\Warehouse;
use App\Models\OutputType;
use App\Tables\Warehouses;
use App\Models\Departament;
use Illuminate\Http\Request;
use App\Models\WareHouseMovement;
use Illuminate\Support\Facades\DB;
use App\Tables\WarehousesMovements;
use App\Tables\WarehouseStockTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\Warehouse\TransferRequest;
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

    public function movements(Warehouse $warehouse)
    {
        $movements_table = new WarehousesMovements($warehouse->id);
        return view('modules.warehouses.movements', [
            'warehouse' => $warehouse,
            'movements' => $movements_table
        ]);
    }

    public function movementsDetails(Warehouse $warehouse, WareHouseMovement $movement) {
        return view('modules.warehouses.movement-details', [
            'movement' => $movement
        ]);
    }

    public function stock(Warehouse $warehouse)
    {
        $stock_table = new WarehouseStockTable($warehouse);
        return view('modules.warehouses.stock', [
            'warehouse' => $warehouse,
            'stock' => $stock_table
        ]);
    }

    public function formTrasfer()
    {
        return view('modules.warehouses.transfers.new', [
            'warehouses' => Warehouse::all(),
            'stores' => Store::all(),
        ]);
    }

    public function storeTransfer(TransferRequest $request)
    {
        //store transfer

        try {
            $warehouse = Warehouse::find($request->warehouse_id);
            $store = Store::find($request->store_id);
            DB::beginTransaction();

            $transfer = Transfer::create([
                'status' => 'approved',
                'warehouse_id' => $request->warehouse_id,
                'store_id' => $request->store_id,
                'requested_by' => auth()->user()->id,
                'approved_at' => now(),
            ]);

            $input = InputType::whereAlias('traslado')->first();
            $output = OutputType::whereAlias('traslado')->first();

            $movementWarehouse = $warehouse->movements()->create([
                'type' => 'ouput',
                'output_type_id' => $output->id,
                'type_action' => route('transfer.details', [$transfer->id]),
                'warehouse_id' => $warehouse->id,
                'date' => date('Y-m-d')
            ]);

            $movementStore = $store->movements()->create([
                'type' => 'input',
                'input_type_id' => $input->id,
                'type_action' => route('transfer.details', [$transfer->id]),
                'store_id' => $store->id,
                'date' => now()
            ]);


            foreach($request->products as $product)
            {
                $transfer->products()->attach($product['id'], ['quantity' => $product['quantity']]);

                $movementWarehouse->details()->create([
                    'warehouse_id' => $warehouse->id,
                    'product_id' => $product['id'],
                    'total' => $product['quantity'],
                ]);

                $movementStore->details()->create([
                    'store_id' => $store->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                ]);

                //update stock warehouse
                $productStockWareouse = $warehouse->products()->where('id', $product['id'])->first();
                $total = $productStockWareouse->pivot->quantity - $product['quantity'];
                $warehouse->products()->updateExistingPivot($product['id'], ['quantity' => $total]);

                //update stock stores
                if(!$store->products()->where('id', $product['id'])->first()) {
                    $store->products()->attach($product['id'], ['quantity' => $product['quantity']]);
                }else {
                    $productStock = $store->products()->where('id', $product['id'])->first();
                    $total = $productStock->pivot->quantity + $product['quantity'];
                    $store->products()->updateExistingPivot($product['id'], ['quantity' => $total]);
                }

            }

            /* $warehouse->comments()->create([
                'user_id' => auth()->user()->id,
                'comment' => "Se ha registrado un tralado a la tienda  {$store->name}",
                'type' => 'comment',
                'action' =>  "https://sisven.test",
            ]); */

            DB::commit();

            Toast::title('Exito!')
            ->center('EL traslado se ha efectuado con éxito')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('wr.index');

        }catch(\Exception $e) {
            dd($e->getMessage().$e->getLine());
        }
    }

    public function getProductsByWarehouse($id)
    {
        $warehouse = Warehouse::find($id);

        $products = $warehouse->products()->get()->transform(function($item) {
            $p = new \stdClass();
            $p->id = $item->id;
            $p->name = $item->full_name." (".$item->measure->name.")";
            return $p;
        });


        return response()->json($products);
    }

    public function getProduct($id, $productId)
    {
        $product = Product::find($productId);
        $stock = $product->warehouses()->where('id', $id)->first();
        $quantity = $stock->pivot->quantity;

        if(!$product) {
            return response()->json(['error' => 'No se ha encontrado'], 422);
        }

        $response = [];
        $response['id'] = $product->id;
        $response['name'] = $product->full_name." ({$product->measure->name})";
        $response['avalaible'] = $quantity;
        $response['quantity'] = null;

        return response()->json(['product' => $response]);
    }
}
