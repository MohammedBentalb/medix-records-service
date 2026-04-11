<?php

namespace App\Actions;

use App\Models\Visit;

class ShowVisitAction {
    public function execute(string $id){
        return Visit::with(['diagnoses', 'prescription.items'])->findOrFail($id);
    }
}
