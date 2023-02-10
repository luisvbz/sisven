<?php

namespace App\Tables;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class Products extends AbstractTable
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
        return Product::query();
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
            ->defaultSort('-created_at')
            ->column(key: 'type.name',label: 'Tipo', searchable: true)
            ->column(key: 'code', label: 'Código', highlight: true, searchable: true)
            ->column(key: 'description', label: 'descripcion')
            ->column(key: 'price_formated', label: 'Precio', highlight: true)
            ->column(key: 'cost_formated', label: 'Costo', highlight: true)
            ->column(key: 'measure.name', label: 'medida')
            ->column(label:'stock')
            ->column(label:'acciones')
            ->selectFilter(
                key:'type_id',
                noFilterOptionLabel: 'Todos',
                label: 'Tipo',
                options: $this->getTypes()
            )
            //->rowModal(fn (Product $product) => route('pr.stock-tiendas', ['product' => $product]))

            ->paginate(30);
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
