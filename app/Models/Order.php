<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y'),
        );
    }

}
