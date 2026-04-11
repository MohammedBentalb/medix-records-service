<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['visit_id', 'notes'])]
class Prescription extends Model {
    use HasUuids;

    public function visit(): BelongsTo {
        return $this->belongsTo(Visit::class);
    }

    public function items(): HasMany {
        return $this->hasMany(PrescriptionItem::class);
    }
}
