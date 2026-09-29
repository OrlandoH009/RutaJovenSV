<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name', 'slug', 'logo_path', 'department', 'municipality',
    'institution_type', 'website', 'contact_info', 'latitude', 'longitude',
])]
class Institution extends Model
{
    protected function casts(): array
    {
        return [
            'contact_info' => 'array',
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    public function careers(): BelongsToMany
    {
        return $this->belongsToMany(Career::class, 'institution_careers')
            ->withPivot(['modality', 'requirements', 'cost_info'])
            ->withTimestamps();
    }

    public function savedByUsers(): HasMany
    {
        return $this->hasMany(SavedInstitution::class);
    }
}
