<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apunte extends Model
{
    /** @use HasFactory<\Database\Factories\ApunteFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'materia_id', 'titulo', 'descripcion', 'ruta_archivo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
