<?php

namespace App\Tables;

use App\Models\Product;
use App\Models\Warehouse;
use App\Models\ProductType;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class WarehouseStockTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    private $warehouse;
    public function __construct(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
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
        ->with(['warehouses' => function($q) {
            $q->where('id', $this->warehouse->id)
                ->select('quantity');
            }
        ])
        ->whereIn('id', $this->warehouse->products->pluck('id')->toArray());
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
