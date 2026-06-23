<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    /** @use HasFactory<\Database\Factories\PrescriptionFactory> */
    use HasFactory;
    protected $fillable = [
        'medication_name',
        'dosage',
        'frequency',
    ];
    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }
}
