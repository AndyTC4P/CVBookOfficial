<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function empresa()
    {
        return $this->belongsTo(User::class, 'empresa_id');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}
