<?php

namespace App\Tables;

use App\Models\Bill;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Bills extends AbstractTable
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
        $bill = Bill::query();
        $bill->withCount('items')->orderBy('created_at', 'DESC');
        return $bill;
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
            ->withGlobalSearch(columns: ['number','client.name'])
            ->column(label: 'estado')
            ->column(label: 'tipo', highlight: true)
            ->column(label: 'numero', highlight: true)
            ->column(key:'emition_date', label: 'Fecha')
            ->column(key:'client.name', label: 'Cliente')
            ->column(key:'items_count', label: 'Items', highlight: true)
            ->column(label: 'gravada')
            ->column('igv')
            ->column('archivo')
            ->column(label: 'total',highlight: true)
            ->column(label: 'acciones')
            ->selectFilter(
                key:'status',
                noFilterOptionLabel: 'Todos',
                label: 'Estado',
                options: [
                    'proccesed' => 'Procesados',
                    'canceled' => 'Anulados',
                ]
            )
            ->paginate(30);
    }
}
