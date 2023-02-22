<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WareHouseMovement extends Model
{
    use HasFactory;

    protected $table = 'warehouse_stock_movements';

    protected $fillable = [
        'type',
        'input_type_id',
        'output_type_id',
        'type_action',
        'warehouse_id',
        'date'
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function input()
    {
        return $this->belongsTo(InputType::class, 'input_type_id');
    }

    public function output()
    {
        return $this->belongsTo(OutputType::class, 'output_type_id');
    }

    public function details()
    {
        return $this->hasMany(WRMovementDetail::class, 'movement_id');
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y'),
        );
    }
}
