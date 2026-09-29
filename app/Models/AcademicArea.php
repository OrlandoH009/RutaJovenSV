<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description', 'icon'])]
class AcademicArea extends Model
{
    public function careers(): HasMany
    {
        return $this->hasMany(Career::class);
    }
}
