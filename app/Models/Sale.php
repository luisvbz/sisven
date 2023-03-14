<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'client_id',
        'store_id',
        'user_id',
        'has_discount',
        'currency',
        'discount_percent',
        'sub_total',
        'total'
    ];


    public function products()
    {
        return $this->hasMany(SaleProduct::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalFormatedAttribute()
    {
        return "S/ ".number_format($this->total, 2,".", ",");
    }

}
