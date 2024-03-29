<?php

namespace App\Http\Controllers;

use App\Tables\Users;
use App\Models\Module;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $modules = Module::orderBy('name')->get();
        return view('dashboard', ['modules' => $modules]);
    }
}
