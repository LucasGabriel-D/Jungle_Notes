<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apunte extends Model
{
    /** @use HasFactory<\Database\Factories\ApunteFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'materia_id', 'titulo', 'descripcion', 'ruta_archivo'];

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, $this> */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Materia, $this> */
    public function materia(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }

    /** @return \Illuminate\Database\Eloquent\Relations\HasMany<Comentario, $this> */
    public function comentarios(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comentario::class);
    }
}
