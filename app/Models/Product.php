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
        'minimun_stock',
        'measure_id',
        'price',
        'cost',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'products_stock', 'product_id', 'store_id')
        ->withPivot(['package_quantity','quantity_sunat', 'quantity']);
    }


    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function measure()
    {
        return $this->belongsTo(ProductMeasure::class, 'measure_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->type->name} {$this->code} {$this->description}";
    }

    public function getFullStockAttribute()
    {
        return $this->stores->sum('pivot.quantity');
    }

    public function getAlertStockAttribute()
    {
        return $this->full_stock <= $this->minimun_stock;
    }

    public function getPriceFormatedAttribute()
    {
        return "S/ ".number_format($this->price, 2,".", ",");
    }

    public function getCostFormatedAttribute()
    {
        return "S/ ".number_format($this->cost, 2,".", ",");
    }

    public function getFullStockFormatedAttribute()
    {
        return number_format($this->full_stock, 0,"", ",");
    }
}
