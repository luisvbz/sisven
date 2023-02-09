<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = 'products_types';

    protected $fillable = [
        'name',
        'alias',
        'category',
        'package_id'
    ];


    public function package()
    {
        return $this->belongsTo(ProductPackage::class, 'package_id');
    }

    public function getPackageNameAttribute()
    {
        return "{$this->name} - ({$this->package->name})";
    }
}
