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
        $types = ProductType::with('package')->orderBy('name')->get();
        $measures = ProductMeasure::orderBy('name')->get();
        $stores = Store::orderBy('is_principal', 'DESC')->get(['code', 'name', 'id']);
        return view('modules.products.add', [
            'types' => $types,
            'measures' => $measures,
            'stores' => $stores
        ]);
    }
}
