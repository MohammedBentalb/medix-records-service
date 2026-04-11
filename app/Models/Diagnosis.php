<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['visit_id', 'name', 'type', 'severity', 'notes'])]
class Diagnosis extends Model {
    use HasUuids;

    public function visit(): BelongsTo {
        return $this->belongsTo(Visit::class);
    }
}
