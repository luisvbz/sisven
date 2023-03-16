<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\SaleType;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    public function new()
    {
        $docs = [
            'FACT' => 'Factura',
            'BOL' => 'Boleta',
            'NDC' => 'Nota de Crédito',
            'NDD' => 'Nota de D¿ebito',
        ];

        return view('modules.bills.new', [
            'types' => SaleType::all(),
            'docs' => $docs
        ]);
    }

    public function index()
    {
        return view('modules.bills.index');
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


    public function getProducts(Request $request)
    {
        $query = $request->get('query');
        $products = Product::get()
            ->transform(function($product) {
                $item = [];
                $item['id'] = $product->id;
                $item['full_name'] = "($product->code) - {$product->type->name} {$product->description} ";
                $item['measure'] = $product->measure->name;
                $item['price'] = $product->price;
                return $item;
            });

        $products = $products->filter(function($item) use ($query) {
            return strpos($item['full_name'], strtoupper($query)) !== false;
        })->values();

        return response()->json(['products' => $products]);
    }
}
