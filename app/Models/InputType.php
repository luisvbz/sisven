<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputType extends Model
{
    use HasFactory;

    protected $table = "inputs_types";

    protected $fillable = [
        'name',
        'alias'
    ];
}
