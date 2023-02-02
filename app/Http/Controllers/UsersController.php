<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        return view('modules.users.index', ['users' => Users::class]);
    }

    public function add(Request $request)
    {
        return view('modules.users.add', ['roles' => User::getRolesAllowed()]);
    }
}
