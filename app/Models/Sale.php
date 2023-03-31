<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'number',
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

    public static function generarNumeroConsecutivo()
    {
        $ultimoRegistro = self::latest('created_at')->first();
        $anioActual = date('Y');
        if ($ultimoRegistro) {
            $ultimoNumeroConsecutivo = $ultimoRegistro->number;
            // Verificar si el número consecutivo pertenece al año actual
            if (substr($ultimoNumeroConsecutivo, 0, 4) == $anioActual) {
                $ultimoNumero = (int)substr($ultimoNumeroConsecutivo, -5);
                $numeroConsecutivo = $ultimoNumero + 1;
            } else {
                $numeroConsecutivo = 1;
            }
        } else {
            $numeroConsecutivo = 1;
        }

        // Formatear el número consecutivo con el año actual
        return $anioActual . str_pad($numeroConsecutivo, 5, '0', STR_PAD_LEFT);
    }

    public function justification()
    {
        return $this->hasOne(SaleJustification::class, 'sale_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentMenthod::class, 'sale_id');
    }

}
