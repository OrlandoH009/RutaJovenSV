<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['institution_id', 'career_id', 'official_career_name', 'modality', 'requirements', 'cost_info'])]
class InstitutionCareer extends Model
{
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    public function curriculumItems(): HasMany
    {
        return $this->hasMany(CurriculumItem::class)
            ->orderByRaw('cycle_number IS NULL, cycle_number')
            ->orderBy('sort_order');
    }
}
