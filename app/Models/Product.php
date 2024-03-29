<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_product', 'product_id', 'warehouse_id')
        ->withPivot(['quantity','description_quantity']);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_product', 'product_id', 'store_id')
        ->withPivot(['quantity','description_quantity']);
    }


    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function measure()
    {
        return $this->belongsTo(ProductMeasure::class, 'measure_id');
    }

    public function entrances()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->type->name} {$this->code} {$this->description}";
    }

    public function getFullStockAttribute()
    {
        return $this->warehouses->sum('pivot.quantity')+$this->stores->sum('pivot.quantity');
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

    public function saleItems()
    {
        return $this->hasMany(SaleProduct::class);
    }
}
