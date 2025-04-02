<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    use HasFactory;

    protected $table = 'cvs';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'titulo',
        'perfil',
        'imagen',
        'correo',
        'telefono',
        'direccion',
        'pais',
        'ciudad',
        'experiencia',
        'educacion',
        'habilidades',
        'idiomas',
        'publico',
        'slug', // 👈 Agrega esta línea
    ];
    

    protected $casts = [
        'experiencia' => 'array',
        'educacion' => 'array',
        'habilidades' => 'array',
        'idiomas' => 'array',
        'publico' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



