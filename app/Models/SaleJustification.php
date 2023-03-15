<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleJustification extends Model
{
    use HasFactory;
    protected $table = 'sales_justifications';

    protected $fillable = [
        'sale_id',
        'user_id',
        'justification'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
