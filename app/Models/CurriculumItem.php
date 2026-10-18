<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'institution_career_id', 'cycle_number', 'cycle_label',
    'subject_name', 'subject_code', 'credits', 'sort_order',
])]
class CurriculumItem extends Model
{
    public function institutionCareer(): BelongsTo
    {
        return $this->belongsTo(InstitutionCareer::class);
    }
}
