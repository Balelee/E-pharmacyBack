<?php

namespace App\Http\Controllers;

use App\Http\Resources\PharmacyResource;
use App\Models\Pharmacy;
use App\Models\PharmacyGarde;
use Carbon\Carbon;

class PharmacyGardeController extends Controller
{
    public function pharmaciesDeGarde()
    {
        $now = Carbon::now();
        $date = $now->toDateString();
        $periode = PharmacyGarde::whereDate('date_debut', '<=', $date)
            ->whereDate('date_fin', '>=', $date)
            ->first();
        if (! $periode) {
            return response()->json(['message' => 'Aucune garde prévue pour cette date.']);
        }
        $pharmacies = Pharmacy::where('groupe', $periode->groupe)->get();

        return PharmacyResource::collection($pharmacies);
    }
}
