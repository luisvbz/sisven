<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'comment',
        'type',
        'action',
        'done',
    ];

    protected $casts = [
        'done' => 'boolean'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
