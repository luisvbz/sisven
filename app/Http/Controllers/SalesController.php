<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Store;
use App\Tables\Sales;
use App\Models\Client;
use App\Models\Product;
use App\Models\SaleType;
use App\Models\InputType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Sales\NewSaleRequest;

class SalesController extends Controller
{
    public function new()
    {
        $stores = $this->getMyStores();
        return view('modules.sales.new', [
            'types' => SaleType::all(),
            'stores' => $stores,
            'store' => auth()->user()->hasRole('vendedor') ?  $stores : null
        ]);
    }

    public function index()
    {
        return view('modules.sales.index', ['sales' => Sales::class]);
    }

    private function getMyStores()
    {
        if(auth()->user()->hasRole('vendedor'))
        {
            $stores = auth()->user()->stores;
            if(count($stores) == 1) {
                $stores = $stores[0];
            }
        }elseif(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')) {
            $stores = Store::get();
        }

        return $stores;
    }

    public function store(NewSaleRequest $request)
    {
        try {
            $data = $request->all();
            //saveing sale
            DB::beginTransaction();
            $store = Store::find($request->store_id);
            $sale = Sale::create([
                'number' => Sale::generarNumeroConsecutivo(),
                'client_id'=> $data['client_id'],
                'store_id'=> $data['store_id'],
                'user_id'=> auth()->user()->id,
                'has_discount'=> false,
                'currency'=> "S",
                'discount_percent'=> 0,
                'sub_total'=> $data['total'],
                'total' => $data['total']
            ]);

            foreach($data['products'] as $product) {
                if(!$product['omit']) {
                    $typeSale = SaleType::find($product['type_sale']);
                    $totalProduct = $typeSale->quantity*$product['quantity_type'];
                    $sale->products()->create([
                        'product_id' => $product['product_id'],
                        'type_id' => $product['type_sale'],
                        'quantity_type' => $product['quantity_type'],
                        'quantity_total' => $totalProduct,
                        'unit_price' => $product['unit_price'],
                        'total' => $product['total_price']
                    ]);

                    //update stock
                    $productStock = $store->products()->where('id', $product['product_id'])->first();
                    $total = $productStock->pivot->quantity - $totalProduct;
                    $store->products()->updateExistingPivot($product['product_id'], ['quantity' => $total]);
                }
            }

            DB::commit();

            Toast::title('Exito!')
            ->center('La venta se ha realizado con éxito')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

        return redirect()->route('ve.show', [$sale]);

        }catch(\Exception $e) {
            dd($e->getMessage().$e->getLine());
        }
        //dd($request->all());
    }

    public function cancelSale(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'justification' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $justificacion = $request->justification;
        $sale = Sale::find($request->sale_id);
        $store = Store::find($sale->store_id);
        $input = InputType::whereAlias('venta-cancelada')->first();

        DB::beginTransaction();

        $movementStore = $store->movements()->create([
            'type' => 'input',
            'input_type_id' => $input->id,
            'type_action' => route('ve.show', [$sale]),
            'store_id' => $store->id,
            'date' => now()
        ]);

        foreach($sale->products as $product) {
            $productStock = $store->products()->where('id', $product->product_id)->first();
            $total = $productStock->pivot->quantity + $product->quantity_total;
            $store->products()->updateExistingPivot($product->product_id, ['quantity' => $total]);

            $movementStore->details()->create([
                'store_id' => $store->id,
                'product_id' => $product->id,
                'quantity' => $product->quantity_total,
            ]);
        }

        $sale->justification()->create([
            'user_id' => auth()->user()->id,
            'justification' => $justificacion
        ]);

        $sale->status = 'canceled';
        $sale->save();

        DB::commit();


        Toast::title('Exito!')
        ->center('La venta se ha cancelado con éxito')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('ve.show', [$sale]);

    }

    public function show(Sale $sale)
    {
        return view('modules.sales.show', ['sale' => $sale]);
    }

    public function getProductosByStore(Request $request, $storeId)
    {
        #xkwhczal
        $store = Store::find($storeId);
        $query = $request->get('query');
        $products = Product::query()
            ->with(['stores' => function($q) use ($storeId) {
                $q->where('id', $storeId)
                    ->select('quantity');
                }
            ])
            ->whereIn('id', $store->products->pluck('id')->toArray())
            ->get()
            ->transform(function($product) {
                $item = [];
                $item['id'] = $product->id;
                $item['full_name'] = "($product->code) - {$product->type->name} {$product->description} ";
                $item['stock'] = $product->stores[0]->pivot->quantity;
                $item['measure'] = $product->measure->name;
                $item['price'] = $product->price;

                return $item;
            });

        $products = $products->filter(function($item) use ($query) {
            return strpos($item['full_name'], strtoupper($query)) !== false;
        })->values();

        return response()->json(['products' => $products]);
    }


    public function getClients(Request $request)
    {
        $query = $request->get('query');
        if($query == '') return;
        $clients = Client::where('document_number','like', "%{$query}%")
                            ->orWhere('name','like', "%{$query}%")
                            ->get();

        return response()->json(['clients' => $clients]);
    }
}
