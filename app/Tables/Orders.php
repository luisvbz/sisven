<?php

namespace App\Tables;

use App\Models\Order;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Orders extends AbstractTable
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
        return Order::query()->withCount('details')->orderBy('created_at', 'DESC');
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
            ->column(label: 'estado')
            ->column(key:'supplier.name', label: 'Proveedor', highlight: true)
            ->column(key:'date', label: 'Fecha de Compra', sortable: true)
            ->column(key:'details_count', label: 'Productos')
            ->column(key:'cost_formated', label: 'Costo', highlight: true)
            ->column(label: 'acciones');

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
