<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transfer extends Model
{
    use HasFactory;

    const REQUESTED = 'requested';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const CANCELED = 'canceled';

    protected $fillable = [
        'status',
        'warehouse_id',
        'store_id',
        'requested_by',
        'approved_at',
        'rejected_at',
        'canceled_at',
    ];


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function approvals()
    {
        return $this->morphMany(Approval::class, 'approvable');
    }

    public function justifications()
    {
        return $this->morphMany(Justification::class, 'approvable');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transfer_product')
        ->withPivot(['quantity']);
    }
}
