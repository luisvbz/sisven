<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillItem extends Model
{
    use HasFactory;

    protected $table = 'bills_items';
    public $timestamps = false;

    protected $fillable = [
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
