<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'genero',
    'role',
    'nombre_empresa',
    'telefono',
];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function isEmpresa(): bool
{
    return $this->role === 'empresa';
}

public function isUsuario(): bool
{
    return $this->role === 'usuario';
}
public function favoritos()
{
    return $this->belongsToMany(CV::class, 'cv_favoritos', 'user_id', 'cv_id')->withTimestamps();
}
// Para empresas
public function vacantes()
{
    return $this->hasMany(Vacante::class, 'empresa_id');
}

// Para usuarios normales
public function postulaciones()
{
    return $this->hasMany(Postulacion::class, 'usuario_id');
}

// Relación para acceder a los CVs del usuario
public function cvs()
{
    return $this->hasMany(CV::class, 'user_id');
}


}
