<?php

namespace App\Models;

use Database\Factories\ComentarioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comentario extends Model
{
    /** @use HasFactory<ComentarioFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'apunte_id', 'contenido'];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<Apunte, $this> */
    public function apunte(): BelongsTo
    {
        return $this->belongsTo(Apunte::class);
    }
}
