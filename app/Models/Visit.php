<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['appointment_id', 'patient_id', 'doctor_id', 'chief_complaint', 'clinical_notes'])]
class Visit extends Model {
    use HasUuids;

    protected function casts(): array {
        return [ 'visited_at' => 'datetime'];
    }

    public function diagnoses(): HasMany {
        return $this->hasMany(Diagnosis::class);
    }

    public function prescription(): HasOne {
        return $this->hasOne(Prescription::class);
    }
}
