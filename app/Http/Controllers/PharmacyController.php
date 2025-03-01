<?php

namespace App\Http\Controllers;

use App\Http\Resources\PharmacyResource;
use App\Models\Enums\UserType;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;

class PharmacyController extends BaseController
{
    public function getPharmacies()
    {
        $pharmacies = Pharmacy::all();

        return PharmacyResource::collection($pharmacies);

    }

    public function storePharmacy(Request $request)
    {
        $request->validate([
            'pharmacieName' => Pharmacy::getValidationRule('pharmacieName'),
            'adresse' => Pharmacy::getValidationRule('adresse'),
            'phone' => Pharmacy::getValidationRule('phone'),
        ]);
        $pharmacien = User::where('id', $request->pharmacien_id)->where('userType', UserType::PHARMACIEN->value)->first();

        if (! $pharmacien) {
            return response()->json([
                'message' => 'Cet utilisateur n\'est pas un pharmacien.',
            ], 403);
        }

        $pharmacy = Pharmacy::create([
            'pharmacien_id' => $request->pharmacien_id,
            'pharmacieName' => $request->pharmacieName,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
        ]);

        return new PharmacyResource($pharmacy);
    }

    public function updatePharmacy(Pharmacy $pharmacy, Request $request)
    {
        $request->validate([
            'pharmacieName' => Pharmacy::getValidationRule('pharmacieName'),
            'adresse' => Pharmacy::getValidationRule('adresse'),
            'phone' => Pharmacy::getValidationRule('phone'),
        ]);

        $pharmacy->update([
            'pharmacyName' => $request->pharmacyName,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return new PharmacyResource($pharmacy->refresh());
    }

    public function findPharmacy(Pharmacy $pharmacy)
    {
        return new PharmacyResource($pharmacy);
    }

    public function deletePharmacy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();

        return new PharmacyResource($pharmacy);
    }
}
