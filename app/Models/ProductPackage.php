<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'products_packages';
    protected $orderColumn = "name";

    protected $fillable = [
        'name',
        'alias'
    ];
}
