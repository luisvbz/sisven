<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreMovement extends Model
{
    use HasFactory;

    protected $table = 'store_stock_movements';

    protected $fillable = [
        'type',
        'input_type_id',
        'output_type_id',
        'type_action',
        'store_id',
        'product_id',
        'packages',
        'quantity_per_packages',
        'total',
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function input()
    {
        return $this->belongsTo(InputType::class, 'input_type_id');
    }

    public function output()
    {
        return $this->belongsTo(OutputType::class, 'output_type_id');
    }
}
