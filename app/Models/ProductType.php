<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alias',
        'category',
        'package_id'
    ];


    public function packages()
    {
        return $this->belongsTo(ProductPackage::class, 'package_id');
    }
}
