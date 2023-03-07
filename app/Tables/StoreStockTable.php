<?php

namespace App\Tables;

use App\Models\Store;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class StoreStockTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    private $store;
    public function __construct(Store $store)
    {
        $this->store = $store;
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
        return Product::query()
        ->with(['stores' => function($q) {
            $q->where('id', $this->store->id)
                ->select('quantity');
            }
        ])
        ->whereIn('id', $this->store->products->pluck('id')->toArray());
        //return $this->store->products;
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
            ->withGlobalSearch('Buscar por toda la data...', ['type.name', 'code', 'description'])
            ->column(key: 'type.name',label: 'Tipo', searchable: true)
            ->column(key: 'code', label: 'Código', highlight: true, searchable: true)
            ->column(key: 'description', label: 'descripcion')
            ->column(key: 'price_formated', label: 'Precio', highlight: true)
            ->column(key: 'cost_formated', label: 'Costo', highlight: true)
            ->column(key: 'measure.name', label: 'medida')
            ->column(label:'stock', highlight: true)
            ->selectFilter(
                key:'type_id',
                noFilterOptionLabel: 'Todos',
                label: 'Tipo',
                options: $this->getTypes()
            );

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }

    private function getTypes()
    {
        $options = [];

        foreach(ProductType::all() as $type) {
            $options[$type->id] = $type->name;
        }

        return $options;
    }
}
