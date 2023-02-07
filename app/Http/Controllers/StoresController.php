<?php

namespace App\Http\Controllers;

use App\Tables\Stores;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index(Request $request)
    {
        return view('modules.stores.index', ['stores' => Stores::class]);
    }
}
