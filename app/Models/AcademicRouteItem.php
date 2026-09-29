<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['academic_route_id', 'career_id', 'institution_id', 'position'])]
class AcademicRouteItem extends Model
{
    public function route(): BelongsTo
    {
        return $this->belongsTo(AcademicRoute::class, 'academic_route_id');
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
