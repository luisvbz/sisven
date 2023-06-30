<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = "orders_details";
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'packages',
        'quantity_per_packages',
        'total',
        'cost'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getCostFormatedAttribute()
    {
        return "S/ ".number_format($this->cost, 2,".", ",");
    }
}
