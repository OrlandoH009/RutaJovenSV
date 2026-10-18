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
