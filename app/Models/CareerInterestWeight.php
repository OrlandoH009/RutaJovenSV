<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['career_id', 'interest_key', 'weight'])]
class CareerInterestWeight extends Model
{
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}
