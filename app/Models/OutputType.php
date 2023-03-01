<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputType extends Model
{
    use HasFactory;

    protected $table = "outputs_types";

    protected $fillable = [
        'name',
        'alias'
    ];
}
