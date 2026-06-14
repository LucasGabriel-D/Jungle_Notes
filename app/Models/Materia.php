<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'anio'];

    /** @return \Illuminate\Database\Eloquent\Relations\HasMany<Apunte, $this> */
    public function apuntes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Apunte::class);
    }
}
