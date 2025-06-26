<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Models\PharmacyGarde;
use App\Http\Controllers\Controller;
use App\Http\Resources\PharmacyResource;

class PharmacyGardeController extends Controller
{

    public function pharmaciesDeGarde()
{
    $now = Carbon::now();
    $date = $now->toDateString();
    $periode = PharmacyGarde::whereDate('date_debut', '<=', $date)
        ->whereDate('date_fin', '>=', $date)
        ->first();
    if (!$periode) {
        return response()->json(['message' => 'Aucune garde prévue pour cette date.']);
    }
    $pharmacies = Pharmacy::where('groupe', $periode->groupe)->get();
    return PharmacyResource::collection($pharmacies);
}

}
