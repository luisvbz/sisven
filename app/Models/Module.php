<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'route',
        'permission_to_access'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id')->orderBy('id', 'ASC');
    }
}
