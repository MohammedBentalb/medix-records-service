<?php

namespace App\Http\Requests;

use App\MaladySeverityEnum;
use App\MaladyTypeEnum;
use App\MedicineRouteEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InsertVisitRequest extends FormRequest {
    
    public function rules(): array {
        return [
            'appointment_id' => ['required', 'string'],
            'patient_id' => ['required', 'string'],
            'doctor_id' => ['required', 'string'],
            'chief_complaint' => ['required', 'string'],
            'clinical_notes' => ['required', 'string'],
            // ba9i khass ntcheki   
            'diagnoses' => ['required', 'array'],
            'diagnoses.*.name' => ['required', 'string', 'max:255'],
            'diagnoses.*.type' => ['required', 'string', Rule::in(array_column(MaladyTypeEnum::cases(), 'value'))],
            'diagnoses.*.severity' => ['required', 'string', Rule::in(array_column(MaladySeverityEnum::cases(), 'value'))],
            'diagnoses.*.notes' => ['required', 'string',],
        
            'prescription' => ['nullable', 'array'],
            'prescription.notes' => ['nullable', 'string'],
            'prescription.items' => ['nullable', 'array'],
            'prescription.items.*.medicine_name' => ['required_with:prescription.items', 'string'],
            'prescription.items.*.dosage' => ['required_with:prescription.items', 'string'],
            'prescription.items.*.frequency' => ['required_with:prescription.items', 'string'],
            'prescription.items.*.duration' => ['required_with:prescription.items', 'integer'],
            'prescription.items.*.route' => ['required_with:prescription.items', Rule::in(array_column(MedicineRouteEnum::cases(), 'value'))],
            'prescription.items.*.instructions' => ['required_with:prescription.items', 'string'],
        ];
    }
}
