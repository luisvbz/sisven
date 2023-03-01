<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class STMovementDetail extends Model
{
    use HasFactory;

    protected $table = 'store_stock_movements_details';

    protected $fillable = [
        'movement_id',
        'product_id',
        /* 'packages',
        'quantity_per_packages', */
        'quantity',
    ];


    public function parent()
    {
        return $this->belongsTo(StoreMovement::class, 'movement_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
