<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;
    protected $table = "sales_products";
    public $timestamps = false;

    protected $fillable = [
        'sale_id',
        'product_id',
        'type_id',
        'quantity_type',
        'quantity_total',
        'unit_price',
        'total'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function type()
    {
        return $this->belongsTo(SaleType::class, 'type_id');
    }
}
