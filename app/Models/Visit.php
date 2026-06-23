<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visit extends Model
{
    /** @use HasFactory<\Database\Factories\VisitFactory> */
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'prescription_id',
        'examination_notes',
        'diagnosis',
        'treatment_plan',
        'follow_up_days',
        'attachment_url',
        'finalized_at',
    ];
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }
}
