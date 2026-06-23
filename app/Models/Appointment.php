<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'status',
        'scheduled_at',
        'duration_time',
        'chief_complaint',
        'cancellation_reason',
        'checked_in_at',
    ];
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }
    public function visit(): HasOne
    {
        return $this->hasOne(Visit::class);
    }
}
