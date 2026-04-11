<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['prescription_id', 'medicine_name', 'dosage', 'frequency', 'duration_days', 'route', 'instructions'])]
class PrescriptionItem extends Model {
    use HasUuids;

    protected function casts(): array {
        return ['duration_days' => 'integer'];
    }

    public function prescription(): BelongsTo {
        return $this->belongsTo(Prescription::class);
    }
}
