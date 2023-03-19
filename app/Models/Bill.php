<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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
