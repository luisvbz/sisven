<?php

namespace App\Models;

use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory, SoftDeletes,  PowerJoins;


    protected $fillable = [
        'code',
        'name',
        'is_principal',
        'departament_id',
        'province_id',
        'district_id',
        'address',
        'phone_number'
    ];

    protected $casts = [
        'is_principal' => 'boolean'
    ];


    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }


    public function province()
    {
        return $this->belongsTo(Province::class);
    }


    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_stock', 'store_id', 'product_id')
        ->withPivot(['package_quantity','quantity_sunat', 'quantity']);
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
}
