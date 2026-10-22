<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['institution_id', 'title', 'type', 'starts_on', 'ends_on', 'description', 'url'])]
class CalendarEvent extends Model
{
    public const TYPES = [
        'inscripcion' => 'Inscripciones',
        'admision' => 'Prueba de admisión',
        'beca' => 'Becas',
        'otro' => 'Otro',
    ];

    protected function casts(): array
    {
        return ['starts_on' => 'date', 'ends_on' => 'date'];
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
