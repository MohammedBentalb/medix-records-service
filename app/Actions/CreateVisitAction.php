<?php

namespace App\Actions;

use App\DTO\VisitDTO;
use App\Models\Diagnosis;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class CreateVisitAction {
    

    public function execute(VisitDTO $dto){
        return DB::transaction(function() use($dto){
            $visit = Visit::create([
                'appointment_id' => $dto->appointmentId,
                'doctor_id' => $dto->doctorId,
                'patient_id' => $dto->patientId,
                'chief_complaint' => $dto->chiefComplaint,
                'clinical_notes' => $dto->clinicalNotes,
            ]);

            foreach($dto->diagnoses as $diagnosis){
                Diagnosis::create([
                    'visit_id' => $visit->id,
                    'name' => $diagnosis['name'],
                    'type' => $diagnosis['type'],
                    'severity' => $diagnosis['severity'],
                    'notes' => $diagnosis['notes'],
                ]);
            }
                
            if($dto->prescription){
                $prescription = Prescription::create([
                    'visit_id' => $visit->id,
                    'notes' => $dto->prescription['notes'] ?? '',
                ]);

                foreach($dto->prescription['items'] ?? [] as $item){
                    PrescriptionItem::create([
                    'prescription_id' => $prescription->id,
                    'medicine_name' => $item['medicine_name'],
                    'dosage' => $item['dosage'],
                    'frequency' => $item['frequency'],
                    'duration' => $item['duration'],
                    'route' => $item['route'],
                    'instructions' => $item['instructions'],
                ]);
                }
            }
            return $visit->load(['diagnoses', 'prescription.items']);
        });
    }
}
