<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'codigo',
        'correo',
        'telefono',
        'archivo_original',
        'archivo_ruta',
        'mime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    public function setNombreAttribute($nombre)
    {
        return $this->attributes['nombre'] = strtoupper($nombre);
    }
}
