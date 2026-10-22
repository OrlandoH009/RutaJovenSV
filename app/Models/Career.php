<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'academic_area_id', 'name', 'slug', 'description', 'duration_text',
    'duration_months', 'skills', 'typical_activities', 'professional_fields',
])]
class Career extends Model
{
    private const ICONS = [
        'Desarrollo de Software' => '💻', 'Ciencias de la Computación' => '🖥️', 'Ingeniería en Sistemas' => '⚙️',
        'Ingeniería Civil' => '🏗️', 'Ingeniería Industrial' => '🏭', 'Medicina' => '🩺', 'Enfermería' => '💉',
        'Administración de Empresas' => '📊', 'Mercadeo' => '📣', 'Biología' => '🧬', 'Licenciatura en Educación' => '📚',
        'Diseño Gráfico' => '🎨', 'Comunicaciones y Periodismo' => '🎙️', 'Psicología' => '🧠', 'Arquitectura' => '📐',
        'Derecho' => '⚖️', 'Contaduría Pública' => '🧾', 'Trabajo Social' => '🤝', 'Fisioterapia' => '🦴',
        'Nutrición' => '🥗', 'Odontología' => '🦷', 'Turismo' => '✈️', 'Idiomas y Traducción' => '🌐',
        'Publicidad y Relaciones Públicas' => '📢', 'Ingeniería Agronómica' => '🌱', 'Medicina Veterinaria y Zootecnia' => '🐾',
        'Ingeniería en Alimentos' => '🍞', 'Ingeniería Ambiental' => '🌎', 'Ingeniería Mecánica' => '🔧',
        'Relaciones Internacionales' => '🌍', 'Gastronomía' => '🍳',
    ];

    /** Divide un texto de la BD en elementos (por ; o por comas fuera de paréntesis) para mostrarlo como lista. */
    private function toList(?string $text, string $pattern): array
    {
        return collect(preg_split($pattern, rtrim(trim($text ?? ''), '.')))
            ->map(fn ($item) => \Illuminate\Support\Str::ucfirst(trim($item)))
            ->filter()
            ->values()
            ->all();
    }

    public function getSkillsListAttribute(): array
    {
        return $this->toList($this->skills, '/,(?![^(]*\))/');
    }

    public function getActivitiesListAttribute(): array
    {
        return $this->toList($this->typical_activities, '/;/');
    }

    public function getFieldsListAttribute(): array
    {
        return $this->toList($this->professional_fields, '/,(?![^(]*\))/');
    }

    /** Emoji que representa la carrera (🎓 si no hay uno asignado). */
    public function getIconAttribute(): string
    {
        return self::ICONS[$this->name] ?? '🎓';
    }

    public function academicArea(): BelongsTo
    {
        return $this->belongsTo(AcademicArea::class);
    }

    public function interestWeights(): HasMany
    {
        return $this->hasMany(CareerInterestWeight::class);
    }

    public function institutions(): BelongsToMany
    {
        return $this->belongsToMany(Institution::class, 'institution_careers')
            ->withPivot(['id', 'official_career_name', 'modality', 'requirements', 'cost_info'])
            ->withTimestamps();
    }

    public function savedByUsers(): HasMany
    {
        return $this->hasMany(SavedCareer::class);
    }
}
