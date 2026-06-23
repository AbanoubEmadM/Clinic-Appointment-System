<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'full_name',
        'date_of_birth',
        'gender',
        'blood_type',
        'allergies',
        'chronic_conditions',
        'emergency_contact',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    public function doctorReviews(): HasMany
    {
        return $this->hasMany(DoctorReview::class);
    }

}
