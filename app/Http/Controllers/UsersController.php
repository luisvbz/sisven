<?php

namespace App\Http\Controllers;

use App\Tables\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        return view('modules.users.index', ['users' => Users::class]);
    }
}
