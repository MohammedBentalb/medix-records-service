<?php

namespace App\Http\Controllers;

use App\Actions\CreateVisitAction;
use App\Actions\ShowPatientVisitsAction;
use App\Actions\ShowVisitAction;
use App\DTO\VisitDTO;
use App\Http\Requests\InsertVisitRequest;
use App\Http\Responses\ApiResponse;
use App\Http\Resources\VisitResource;
use App\Models\Visit;

class VisitsController extends Controller {
    public function store(InsertVisitRequest $request, CreateVisitAction $createVisitAction) {
        $visit = $createVisitAction->execute(VisitDTO::fromRequest($request));
        return ApiResponse::success(new VisitResource($visit), 201);
    }

    public function show(string $id, ShowVisitAction $showVisitAction) {
        return ApiResponse::success(new VisitResource($showVisitAction->execute($id)));
    }

    public function patientRecords(string $patientId, ShowPatientVisitsAction $showPatientVisitsAction) {
        return ApiResponse::success(VisitResource::collection($showPatientVisitsAction->execute($patientId)));
    }
}
