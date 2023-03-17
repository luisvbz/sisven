<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiilItem extends Model
{
    use HasFactory;

    protected $table = 'bills_items';

    protected $fillable = [
        'bill_id',
        'product_id',
        'quantity',
        'measure',
        'unit_price',
        'discount',
        'total',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
