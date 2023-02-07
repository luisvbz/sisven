<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\Permission\Models\Role;

class Users extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */

   private $roles;
    public function __construct()
    {
        $this->roles = User::getRolesAllowed();
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $users = User::query();
        return $users->whereHas('roles', fn($q) => $q->whereIn('name', $this->roles->pluck('name')->toArray()))->where('id', '<>', auth()->user()->id);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch('Buscar por toda la data...', ['name', 'email', 'username', 'dni'])
            ->column('Estado')
            ->column('Usuario')
            ->column(
                key: 'name',
                label: 'Nombre',
                sortable: true
                )
            ->column('email', 'Correo Electrónico')
            ->column('Rol')
            ->column('Actions')
            ->selectFilter(
                key:'status',
                noFilterOptionLabel: 'Todos',
                label: 'Estado',
                options: [
                    '1' => 'Activo',
                    '0' => 'Inactivo',
                ]
            )
            ->selectFilter(key:'roles.name',
            noFilterOptionLabel: 'Todos',
            label:'Rol' ,
            options: $this->getOptionsRoles())
            ->paginate(20);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }

    private function getOptionsRoles()
    {
        $options = [];

        foreach($this->roles as $rol) {
            $options[$rol->name] = $rol->display_name;
        }

        return $options;

    }
}
