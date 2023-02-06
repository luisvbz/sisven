<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Tables\Users;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\Users\UserStoreRequest;
use App\Notifications\UserCreated;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        return view('modules.users.index', ['users' => Users::class]);
    }

    public function add(Request $request)
    {
        return view('modules.users.add', [
            'roles' => User::getRolesAllowed(),
            'modules' => Module::with('permissions:name,display_name,module_id')->orderby('name', 'ASC')->get(['id', 'name'])
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        try {

           DB::beginTransaction();

            $user = User::create($request->except(['rol', 'permissions', 'password_confirmation']));

            $user->assignRole($request->only(['rol']));
            $user->givePermissionTo($request->only(['permissions']));

            DB::commit();

            //$user->notify(new UserCreated($user, $request->only(['password'])));

            Toast::title('Exito!')
            ->center('El usuario se ha creado satisfactoriamente')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('us.index');


        }catch(\Exception $e) {
            Toast::center('Error!')
            ->message($e->getMessage())
            ->backdrop()
            ->danger();
        }
    }
}
