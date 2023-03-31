<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'client_id',
        'status',
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

    protected function emitionDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y'),
        );
    }

    public function getTotalGravadaFormatedAttribute()
    {
        return number_format($this->total_grabada, 2,".", ",");
    }

    public function getTotalIgvFormatedAttribute()
    {
        return number_format($this->total_igv, 2,".", ",");
    }

    public function getTotalFormatedAttribute()
    {
        return number_format($this->total, 2,".", ",");
    }

    public function getFileAttribute()
    {
        return isset($this->getMedia('bills')[0]) ? $this->getMedia('bills')[0]->getUrl() : null;
    }

}
