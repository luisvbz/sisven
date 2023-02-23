<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approvable_type',
        'approvable_id',
        'justification',
        'action',
    ];

    protected $hidden = [
        'approvable_type', 'approvable_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvable()
    {
        return $this->morphTo();
    }
}
