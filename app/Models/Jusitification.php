<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jusitification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'justifiable_type',
        'justifiable_id',
        'justification',
        'action',
    ];

    protected $hidden = [
        'justifiable_type', 'justifiable_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function justifiable()
    {
        return $this->morphTo();
    }
}
