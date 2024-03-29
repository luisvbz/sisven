<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeasure extends Model
{
    use HasFactory;

    protected $table = 'products_measures';

    protected $fillable = [
        'name',
        'alias',
    ];
}
