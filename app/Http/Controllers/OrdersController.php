<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Enums\SupplierStatuses;

class OrdersController extends Controller
{
    public function index()
    {
        return view('modules.orders.index');
    }


    public function create()
    {
        return view('modules.orders.add', [
            'suppliers' => Supplier::whereStatus(SupplierStatuses::ACTIVE)->get(),
            'products' => Product::all()
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
