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
        'name',
        'type',
        'departament_id',
        'province_id',
        'district_id',
        'address',
        'phone_number'
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
        return $this->belongsToMany(Product::class, 'store_product');
    }

    public function movements()
    {
        return $this->hasMany(StoreMovement::class, 'store_id');
    }
}
