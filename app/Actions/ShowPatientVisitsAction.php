<?php

namespace App\Actions;

use App\Models\Visit;

class ShowPatientVisitsAction {
    public function execute(string $id){
        return Visit::with(['diagnoses', 'prescription.items'])->where('patient_id', $id)->orderBy('visited_at', 'desc')->get();
    }
}
