<?php

namespace App\Tables;

use Illuminate\Http\Request;
use App\Models\StoreMovement;
use App\Models\WareHouseMovement;
use App\Models\WarehousesMovement;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class StoresMovements extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    private $store_id;
    public function __construct($store_id)
    {
        $this->store_id = $store_id;
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
        $query =  StoreMovement::query();
        $query->withCount('details')
        ->where('store_id', $this->store_id)
        ->orderBy('date','DESC');
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
            ->column(label: 'enlace')
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
