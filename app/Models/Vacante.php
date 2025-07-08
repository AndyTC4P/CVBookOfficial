<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Postulacion;

class Vacante extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'titulo',
        'descripcion',
        'categoria',
        'ubicacion',
        'modalidad',
        'tipo_contrato',
        'slug', // ← IMPORTANTE
    ];

    public function empresa()
    {
        return $this->belongsTo(User::class, 'empresa_id');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vacante) {
            $vacante->slug = Str::slug($vacante->titulo) . '-' . Str::random(6);
        });
    }
}

