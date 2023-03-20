<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'address',
        'phone_office',
        'phone_celular',
        'email',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
            get: fn ($value) => strtoupper($value),
        );
    }

    public function sales()
    {
        return $this->hasMany(Sale::class)->where('status', 'proccesed');
    }
}
