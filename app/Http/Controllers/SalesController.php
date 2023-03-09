<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Client;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function new()
    {
        $stores = $this->getMyStores();
        $clients = Client::select('id','name','document_type', 'document_number')->get();
        return view('modules.sales.new', [
            'stores' => $stores,
            'clients' => $clients
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
}
