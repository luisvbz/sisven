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
        return Bill::query();
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
            ->column(key:'serie', label: 'Serie', highlight: true)
            ->column(key:'number', label: 'Número', highlight: true)
            ->column(key:'emition_date', label: 'Fecha')
            ->column(key:'client.name', label: 'Cliente')
            ->column(key:'total_grabada', label: 'T. Gravada')
            ->column(key:'total_igv', label: 'IGV')
            ->column(key:'total', label: 'Total')
            ;

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
