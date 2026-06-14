<?php

namespace App\Models;

use Database\Factories\MateriaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    /** @use HasFactory<MateriaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'anio'];

    /** @return HasMany<Apunte, $this> */
    public function apuntes(): HasMany
    {
        return $this->hasMany(Apunte::class);
    }
}
