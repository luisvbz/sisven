<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Client;
use App\Models\Product;
use App\Models\SaleType;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function new()
    {
        $stores = $this->getMyStores();
        return view('modules.sales.new', [
            'types' => SaleType::all(),
            'stores' => $stores,
        ]);
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
