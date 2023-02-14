<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class TransfersController extends Controller
{
    public function add()
    {
        $principal = Store::where('is_principal', true)->first();
        $others = auth()->user()->hasRole('vendedor')
                    ?  Store::where('is_principal', false)
                    ->whereIn('id', auth()->user()->stores->pluck('id')->toArray())->get(['id', 'name'])
                    : Store::where('is_principal', false)->get(['id', 'name']);

        $products = $principal->products->transform(function($p){
            $item = new \stdClass();
            $item->id = $p->id;
            $item->name = $p->full_name;
            $item->stock = $p->pivot->quantity;
            $item->quantity = 0;

            return $item;
        });

        return view('modules.stores.transfers.add', [
            'principal' => $principal,
            'others' => $others,
            'products' => $products
        ]);
    }
}
