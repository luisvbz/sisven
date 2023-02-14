<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    const REQUESTED = 'requested';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const CANCELED = 'canceled';

    protected $fillable = [
        'status',
        'origin',
        'destination',
        'requested_by',
        'approved_at',
        'rejected_at',
        'canceled_at',
    ];


    public function storeOrigin()
    {
        return $this->belongsTo(Store::class, 'origin');
    }

    public function storeDestination()
    {
        return $this->belongsTo(Store::class, 'destination');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transfer_product')
        ->withPivot(['quantity']);
    }
}
