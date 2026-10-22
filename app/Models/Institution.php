<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'parent_id', 'name', 'slug', 'logo_path', 'department', 'municipality',
    'institution_type', 'website', 'contact_info', 'latitude', 'longitude',
])]
class Institution extends Model
{
    /** Sedes cuyo nombre no trae la sigla entre paréntesis. */
    private const ACRONYMS = [
        'Universidad de El Salvador' => 'UES',
        'Universidad Don Bosco' => 'UDB',
        'Universidad Gerardo Barrios' => 'UGB',
    ];

    /** Sigla (o nombre corto) sin la sede: "UES", "ITCA-FEPADE", "Instituto Técnico Ricaldone". */
    public function baseName(): string
    {
        if (preg_match('/\(([^)]+)\)/', $this->name, $m)) {
            return $m[1];
        }

        $base = trim(explode(' - ', $this->name)[0]);

        return self::ACRONYMS[$base] ?? $base;
    }

    /** Nombre corto para tarjetas: "UES · Occidente", "ITCA-FEPADE · Santa Tecla". El completo queda en `name`. */
    public function getShortNameAttribute(): string
    {
        $sede = explode(' - ', $this->name)[1] ?? null;

        if (! $sede) {
            return $this->baseName();
        }

        $sede = preg_replace('/^(Sede|Facultad Multidisciplinaria)( de)?\s+/i', '', $sede);

        return $this->baseName().' · '.$sede;
    }

    /** URL del logo PNG: `logo_path` o public/images/logos/{sigla}.png. Null si no hay archivo. */
    public function getLogoUrlAttribute(): ?string
    {
        $candidates = array_filter([$this->logo_path, 'images/logos/'.\Illuminate\Support\Str::slug($this->baseName()).'.png']);

        foreach ($candidates as $path) {
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        return null;
    }

    protected function casts(): array
    {
        return [
            'contact_info' => 'array',
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    /** Solo educación superior; por ahora se excluyen los institutos técnicos de las vistas públicas. */
    public function scopeHigherEducation($query)
    {
        return $query->where(fn ($q) => $q->whereNull('institution_type')->orWhere('institution_type', 'not like', 'Instituto%'));
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /** Sedes/campus de esta universidad. */
    public function campuses(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('name');
    }

    /** Nombre de la sede para el selector: municipio, o 'Sede central'. */
    public function getCampusLabelAttribute(): string
    {
        return $this->municipality ?: 'Sede central';
    }

    /** Carreras distintas de la universidad (sede principal + campus). Requiere careers y campuses.careers cargados. */
    public function getFamilyCareersAttribute()
    {
        return $this->careers->merge($this->campuses->flatMap->careers)->unique('id');
    }

    /**
     * Agrupa las filas por universidad (misma sigla): la que no tiene sufijo ' - sede' es la principal
     * y el resto pasan a ser sus campus. Una sede idéntica a la principal (mismo municipio y carreras)
     * se fusiona con ella. Idempotente: se usa en la migración y al final del seeder.
     */
    public static function linkCampuses(): void
    {
        $groups = self::with('careers')->get()->groupBy(fn (self $i) => $i->baseName());

        foreach ($groups as $rows) {
            if ($rows->count() < 2) {
                continue;
            }

            $parent = $rows->first(fn ($i) => ! str_contains($i->name, ' - ')) ?? $rows->sortBy('id')->first();

            foreach ($rows->where('id', '!=', $parent->id) as $child) {
                $sameCareers = $child->careers->pluck('id')->sort()->values()->all() === $parent->careers->pluck('id')->sort()->values()->all();
                $unused = ! \Illuminate\Support\Facades\DB::table('institution_careers')
                    ->join('curriculum_items', 'curriculum_items.institution_career_id', '=', 'institution_careers.id')
                    ->where('institution_careers.institution_id', $child->id)->exists()
                    && ! \App\Models\SavedInstitution::where('institution_id', $child->id)->exists()
                    && ! \App\Models\AcademicRouteItem::where('institution_id', $child->id)->exists();

                if ($sameCareers && $unused && $child->municipality === $parent->municipality) {
                    $parent->update(array_filter(['latitude' => $child->latitude, 'longitude' => $child->longitude], fn ($v) => $v && ! $parent->latitude));
                    $child->delete();

                    continue;
                }

                $child->update(['parent_id' => $parent->id]);
            }
        }
    }

    public function careers(): BelongsToMany
    {
        return $this->belongsToMany(Career::class, 'institution_careers')
            ->withPivot(['id', 'official_career_name', 'modality', 'requirements', 'cost_info'])
            ->withTimestamps();
    }

    public function savedByUsers(): HasMany
    {
        return $this->hasMany(SavedInstitution::class);
    }
}
