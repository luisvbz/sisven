<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'client_id',
        'type',
        'serie',
        'number',
        'currency',
        'igv_percent',
        'total_grabada',
        'total_inafecta',
        'total_exonerada',
        'total_igv',
        'total',
        'observations',
        'emition_date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(BillItem::class, 'bill_id');
    }

}
