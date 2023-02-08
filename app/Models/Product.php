<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'type_id',
        'code',
        'description',
        'minimum_stock',
        'measure_id',
        'price_per_dozen',
        'price_per_unit',
        'cost',
    ];


    public function stores()
    {
        $this->belongsToMany(Store::class, 'products_stock', 'product_id', 'store_id')
        ->withPivot(['package_qunatity','sunat_qunatity', 'quantity']);
    }


    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function measure()
    {
        return $this->belongsTo(ProductMeasure::class, 'measure_id');
    }
}
