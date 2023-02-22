<?php

namespace App\Tables;

use App\Models\WareHouseMovement;
use App\Models\WarehousesMovement;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class WarehousesMovements extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    private $warehouse_id;
    public function __construct($warehouse_id)
    {
        $this->warehouse_id = $warehouse_id;
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
        $query =  WareHouseMovement::query();
        $query->withCount('details')->where('warehouse_id', $this->warehouse_id);
        return $query;
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
            ->column('tipo')
            ->column('origen')
            ->column(key: 'type_action', label: 'enlace')
            ->column(key: 'details_count', label: 'registros')
            ->column(key: 'date', label: 'fecha')
            ->column('acciones')
            ->selectFilter(
                key:'type',
                noFilterOptionLabel: 'Todos',
                label: 'Tipo',
                options: [
                    'input' => 'Entrada',
                    'output' => 'Salida',
                ]
            )
            ->paginate(100);


            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
