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
        'categoria_profesion', // ✅ <-- Agregado aquí
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
        'slug',
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
 public function guardadoPor()
{
    return $this->belongsToMany(User::class, 'cv_favoritos', 'cv_id', 'user_id')->withTimestamps();
}


}



