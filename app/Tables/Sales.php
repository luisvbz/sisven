<?php

namespace App\Tables;

use App\Models\Sale;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Sales extends AbstractTable
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
        $sales = Sale::query();
        return $sales->withCount('products')->orderBy('created_at', 'DESC');
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
            ->withGlobalSearch(columns: ['client.name', 'user.name', 'created_at'])
            ->defaultSortDesc('created_at')
            ->column('Estado')
            ->column('Fecha')
            ->column(key: 'client.name', label:'Cliente')
            ->column(key: 'user.name', label:'Vendedor')
            ->column(key: 'store.name', label:'Tienda', highlight:true)
            ->column('total',  highlight:true)
            ->column('acciones')
            ->paginate(30);


            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
