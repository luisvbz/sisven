<?php

namespace App\Tables;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Warehouses extends AbstractTable
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
        return Warehouse::query();
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
            ->withGlobalSearch(columns: ['id'])
            ->column(key:'name', label:'Nombre', sortable: true, highlight: true)
            ->column(key:'departament.name', label:'Departamento', sortable: false)
            ->column(key:'province.name', label:'Provincia', sortable: false)
            ->column(key:'district.name', label:'Distrito', sortable: false)
            ->column(key:'address', label:'Dirección', sortable: true)
            ->column('Acciones');

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
