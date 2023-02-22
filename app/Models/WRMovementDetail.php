<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WRMovementDetail extends Model
{
    use HasFactory;

    protected $table = 'warehouse_stock_movements_details';

    protected $fillable = [
        'movement_id',
        'product_id',
        'packages',
        'quantity_per_packages',
        'total',
    ];


    public function parent()
    {
        return $this->belongsTo(WareHouseMovement::class, 'movement_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
