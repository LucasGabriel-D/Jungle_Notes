<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $titulo
 * @property Carbon $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property string $tipo
 * @property string|null $color
 */
class Evento extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'fecha_inicio',
        'fecha_fin',
        'tipo',
        'color',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'datetime',
            'fecha_fin' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
