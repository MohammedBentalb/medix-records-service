<?php

namespace App\DTO;

use App\Http\Requests\InsertVisitRequest;

readonly class VisitDTO {
    public function __construct(
        private string $appointmentId,
        private string $patientId,
        private string $doctorId,
        private string $chiefComplaint,
        private string $clinicalNotes,
        private array $diagnoses,
        private ?array $prescription,
    ){}

    public static function fromRequest(InsertVisitRequest $request){
        return new self(
            appointmentId: $request->validated('appointment_id'),
            patientId: $request->validated('patient_id'),
            doctorId: $request->validated('doctor_id'),
            chiefComplaint: $request->validated('chief_complaint'),
            clinicalNotes: $request->validated('clinical_notes'),
            diagnoses: $request->validated('diagnoses'),
            prescription: $request->validated('prescription'),
        );
    }
}
