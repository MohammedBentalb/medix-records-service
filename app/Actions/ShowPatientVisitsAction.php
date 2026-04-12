<?php

namespace App\Actions;

use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowPatientVisitsAction {
    public function execute(string $id, Request $request){
        $date = $request->query('date') ?  Carbon::parse($request->query('date')) : null;
        return Visit::with(['diagnoses', 'prescription.items'])->where('patient_id', $id)->when($date, function($query) use($date){
            $query->whereDate('visited_at', $date);
        })->orderBy('visited_at', 'desc')->paginate(15);
    }
}
