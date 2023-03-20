<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Tables\Users;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Notifications\UserCreated;
use App\Notifications\UserUpdated;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;

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
            'stores' => Store::orderBy('name', 'ASC')->get(['name', 'id']),
            'modules' => Module::with('permissions:name,display_name,module_id')->orderby('name', 'ASC')->get(['id', 'name'])
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        try {

           DB::beginTransaction();

            $user = User::create($request->except(['rol', 'permissions', 'password_confirmation', 'stores']));

            $user->assignRole($request->only(['rol']));
            $user->givePermissionTo($request->only(['permissions']));

            if($request->rol == 'vendedor') {
                $user->stores()->sync([$request->stores]);
            }

            DB::commit();

            $user->notify(new UserCreated($user, $request->password));

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

    public function edit(User $user)
    {
        $user->rol = $user->roles[0]->name;
        $user->permissions = $user->permissions->pluck('name');
        $user->stores = $user->stores->pluck('id');

        return view('modules.users.edit', [
            'user' => $user,
            'roles' => User::getRolesAllowed(),
            'stores' => Store::orderBy('name', 'ASC')->get(['name', 'id']),
            'modules' => Module::with('permissions:name,display_name,module_id')->orderby('name', 'ASC')->get(['id', 'name'])
        ]);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $user->forceFill([
            'dni' => $request->dni,
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username
        ])->save();

        $user->syncRoles([$request->rol]);
        $user->syncPermissions($request->permissions);

        if($request->rol == 'vendedor') {
            $user->stores()->sync($request->stores);
        }


        //$user->notify(new UserUpdated());


        Toast::title('Exito!')
        ->center('El usuario se ha actualizado con éxito')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('us.index');
    }

    public function toggleStatus(User $user)
    {
        $user->status = !$user->status;
        $user->save();


        Toast::title('Exito!')
        ->rightTop('Operación Satisfactoria')
        ->success()
        ->autoDismiss(15);

        return redirect()->back()->with('success', 'El usuarios se ha desactivado con éxito');
    }


    public function getDetails(User $user)
    {
        return view('modules.users.show', ['user' => $user]);
    }

    public function delete(User $user) {

        $user->delete();

        Toast::title('Exito!')
        ->center('El usuario se ha eliminado satisfactoriamente')
        ->success()
        ->backdrop()
        ->autoDismiss(15);

        return redirect()->route('us.index');
    }
}

