<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    protected $fillable = ['user_id', 'nombre', 'descripcion', 'anio'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function apuntes(): HasMany
    {
        return $this->hasMany(Apunte::class);
    }
}
