<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'department', 'municipality', 'academic_level', 'bachillerato_type'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    public function answers(): HasMany
    {
        return $this->hasMany(UserAnswer::class);
    }

    public function interestProfile(): HasOne
    {
        return $this->hasOne(InterestProfile::class);
    }

    public function savedCareers(): HasMany
    {
        return $this->hasMany(SavedCareer::class);
    }

    public function savedInstitutions(): HasMany
    {
        return $this->hasMany(SavedInstitution::class);
    }

    public function academicRoute(): HasOne
    {
        return $this->hasOne(AcademicRoute::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
