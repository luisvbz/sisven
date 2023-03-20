<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Inventory implements FromCollection, WithHeadings
{

    public function collection()
    {
        $ids = DB::table('store_product')->get()->pluck('product_id')->toArray();
        $ids2 = DB::table('warehouse_product')->get()->pluck('product_id')->toArray();
        $idsss = array_unique(array_merge($ids, $ids));
        return Product::whereIn('id', $idsss)->get()->transform(function($item) {
                $p = new \stdClass();
                $p->tipo = $item->type->name;
                $p->codigo = $item->code;
                $p->descripcion = $item->description;
                $p->unidad_medidad = $item->measure->name;
                $p->cantidad = $item->full_stock;
                $p->precio = $item->price;
                $p->costo = $item->cost;
                return $p;
        });
    }

    public function headings(): array
    {
        return [
            'Tipo',
            'Código',
            'Descripción',
            'Unidad de Medida',
            'Cantidad',
            'Precio',
            'Costo',
        ];
    }
}
