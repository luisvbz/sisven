<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Tables\Orders;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\InputType;
use App\Models\Warehouse;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Enums\SupplierStatuses;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrderCreated;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Orders\OrderStoreRequest;

class OrdersController extends Controller
{
    public function index()
    {
        return view('modules.orders.index', ['orders' => Orders::class]);
    }


    public function create()
    {
        return view('modules.orders.add', [
            'suppliers' => Supplier::whereStatus(SupplierStatuses::ACTIVE)->get(),
            'products' => Product::all(),
            'warehouses' => Warehouse::all()
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        try {

            DB::beginTransaction();
            //create order
            $order = Order::create($request->except(['product_id', 'products', 'warehouse_id']));
            //Create movemente
            $input = InputType::whereAlias('compra')->first();
            $warehouse = Warehouse::find($request->warehouse_id);
            //adding order details
            $movement = $warehouse->movements()->create([
                'type' => 'input',
                'input_type_id' => $input->id,
                'type_action' => route('co.details', [$order]),
                'warehouse_id' => $warehouse->id,
                'date' => $request->date
            ]);

            foreach($request->products as $product)
            {

                $order->details()->create([
                    'product_id' => $product['id'],
                    'packages' => $product['packages'],
                    'quantity_per_packages' => $product['quantity_per_packages'],
                    'total' => $product['packages']*$product['quantity_per_packages'],
                    'cost' => $product['cost']
                ]);

                //saving movements
                $movement->details()->create([
                        'warehouse_id' => $warehouse->id,
                        'product_id' => $product['id'],
                        'packages' => $product['packages'],
                        'quantity_per_packages' => $product['quantity_per_packages'],
                        'total' => $product['packages']*$product['quantity_per_packages'],
                    ]);

              //finding stock and save
              if(!$warehouse->products()->where('id', $product['id'])->first()) {
                $warehouse->products()->attach($product['id'], ['quantity' => $product['packages']*$product['quantity_per_packages']]);
              }else {
                $productStock = $warehouse->products()->where('id', $product['id'])->first();
                $total = $productStock->pivot->quantity + ($product['packages']*$product['quantity_per_packages']);
                $warehouse->products()->updateExistingPivot($product['id'], ['quantity' => $total]);
              }

            }

            $order->comments()->create([
                'user_id' => auth()->user()->id,
                'comment' => "Se ha registrado una compra por {$order->cost}",
                'type' => 'comment',
                'action' =>  route('co.details', [$order]),
            ]);

            Notification::send(User::role('admin')->get(), new OrderCreated($order, auth()->user()));

        DB::commit();

        Toast::title('Exito!')
        ->center('La compra se ha registrado con éxito')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('co.index');

        }catch(\Exception $e) {
           DB::rollback();
           dd($e->getMessage().$e->getLine());
        }
    }

    public function details(Order $order)
    {
        return view('modules.orders.details', [
            'order' => $order,
        ]);
    }
}
