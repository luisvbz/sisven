<?php

namespace App\Tables;

use App\Models\Store;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Stores extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        SpladeTable::hidePaginationWhenResourceContainsOnePage();
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
        return Store::query()->orderBy('created_at', 'DESC');
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
            ->withGlobalSearch(columns: ['code','name','address'])
            ->defaultSort('-created_at')
            ->column(key: 'code',label: 'COD')
            ->column(label: 'Tipo')
            ->column(key: 'name',label: 'Nombre')
            ->column(key: 'departament.name',label: 'Departamento')
            ->column(key: 'province.name',label: 'Provincia')
            ->column(key: 'district.name',label: 'Distrito')
            ->column(key: 'address',label: 'Dirección')
            ->column('actions')
            ->selectFilter(
                key:'type',
                noFilterOptionLabel: 'Todas',
                label: 'Tipo',
                options: [
                    Store::ALMACEN => 'Almacen',
                    Store::TIENDA => 'Tienda',
                ]
            )
            ->paginate(15);
    }
}
