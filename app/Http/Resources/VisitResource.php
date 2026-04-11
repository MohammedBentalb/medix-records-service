<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'appointmentId' => $this->appointment_id,
            'patientId' => $this->patient_id,
            'doctorId' => $this->doctor_id,
            'visitedAt' => $this->visited_at?->toIso8601String(),
            'chiefComplaint' => $this->chief_complaint,
            'clinicalNotes' => $this->clinical_notes,
            'diagnoses' => DiagnosisResource::collection($this->whenLoaded('diagnoses')),
            'prescription' => $this->whenLoaded('prescription', fn() => $this->prescription ? new PrescriptionResource($this->prescription) : null),
            'createdAt'      => $this->created_at?->toIso8601String(),
        ];
    }
}
