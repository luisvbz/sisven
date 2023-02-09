<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\ProductMeasure;

class ProductsController extends Controller
{
    public function index()
    {
        return view('modules.products.index');
    }


    public function add()
    {
        $types = ProductType::orderBy('name')->get();
        $measures = ProductMeasure::orderBy('name')->get();
        $stores = Store::orderBy('is_principal', 'DESC')
            ->get(['code', 'name', 'id', 'is_principal'])
            ->transform(function($item) {
                $store = new \stdClass;
                $store->id = $item->id;
                $store->name = $item->name;
                $store->code = $item->code;
                $store->is_principal = $item->is_principal;
                $store->package_quantity = null;
                $store->quantity = null;

                return $store;
            });
        return view('modules.products.add', [
            'types' => $types,
            'measures' => $measures,
            'stores' => $stores
        ]);
    }
}
