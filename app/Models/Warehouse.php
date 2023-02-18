<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'departament_id',
        'province_id',
        'district_id',
        'address',
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
        return $this->belongsToMany(Product::class, 'warehouse_product');
    }
}
