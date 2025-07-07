<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    public $timestamps = false;
protected $table = 'postulaciones';

    protected $fillable = [
        'vacante_id',
        'usuario_id',
        'cv_id',
        'fecha_postulacion',
    ];

    public function vacante()
    {
        return $this->belongsTo(Vacante::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function cv()
    {
        return $this->belongsTo(CV::class);
    }
}
