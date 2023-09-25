<?php

namespace App\Tables;

use App\Models\Supplier;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Suppliers extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return Supplier::query();
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
            ->withGlobalSearch(columns: ['name','uc'])
            ->column('estado')
            ->column(key:'ruc', label: 'RUC')
            ->column(key:'name', label: 'Razon Social', highlight: true)
            ->column(key:'address', label: 'Dirección')
            ->column(key:'phone_number', label: 'Teléfono')
            ->column('creacion')
            ->column('acciones')
            ->paginate(20);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
