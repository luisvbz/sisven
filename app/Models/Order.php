<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PROCCESED = 'proccesed';

    protected $fillable = [
        'status',
        'supplier_id',
        'cost',
        'date'
    ];

    protected $casts = [
        'done' => 'boolean'
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function getCostFormatedAttribute()
    {
        return "S/ ".number_format($this->cost, 2,".", ",");
    }

}
