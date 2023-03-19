<?php

namespace App\Tables;

use App\Models\Client;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Clients extends AbstractTable
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
        return Client::query();
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
            ->withGlobalSearch(columns: ['document_number', 'name'])
            ->column(label: 'Documento', key: 'document_number')
            ->column(label: 'Razon Social', key: 'name',sortable: true)
            ->column(label: 'Teléfono Fijo', key: 'phone_office')
            ->column(label: 'Teléfono Celular', key: 'phone_celular')
            ->column(label: 'Direccion', key: 'address')
            ->paginate(30);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
