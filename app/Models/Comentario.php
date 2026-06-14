<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /** @use HasFactory<\Database\Factories\ComentarioFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'apunte_id', 'contenido'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apunte()
    {
        return $this->belongsTo(Apunte::class);
    }
}
