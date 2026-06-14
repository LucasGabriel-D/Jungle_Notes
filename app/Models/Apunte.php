<?php

namespace App\Models;

use Database\Factories\ApunteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apunte extends Model
{
    /** @use HasFactory<ApunteFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'materia_id', 'titulo', 'descripcion', 'ruta_archivo'];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<Materia, $this> */
    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }

    /** @return HasMany<Comentario, $this> */
    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class);
    }
}
