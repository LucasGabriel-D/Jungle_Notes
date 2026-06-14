<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'anio'];

    public function apuntes()
    {
        return $this->hasMany(Apunte::class);
    }
}
