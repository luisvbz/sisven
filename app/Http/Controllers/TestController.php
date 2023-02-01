<?php

namespace App\Http\Controllers;

use App\Tables\Users;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {

        return view('dashboard', ['users' => Users::class]);
    }
}
