<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'supplier_id',
        'date'
    ];

    protected $casts = [
        'done' => 'boolean'
    ];


    public function details()
    {
        return $this->hasMany(OrderDetails::class, 'order_od');
    }

}
