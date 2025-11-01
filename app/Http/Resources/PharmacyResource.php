<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Conversion dynamique de la distance
        $formattedDistance = null;
        if (isset($this->distance)) {
            if ($this->distance < 1) {
                // en mètres
                $formattedDistance = round($this->distance * 1000) . ' m';
            } else {
                // en kilomètres
                $formattedDistance = round($this->distance, 2) . ' km';
            }
        }
        return [
            'id' => $this->id,
            'pharmacien_id' => $this->pharmacien_id,
            'name' => $this->name,
            'adresse' => $this->adresse,
            'phone' => $this->phone,
            'is_on_duty' => $this->is_on_duty,
            'is_open_now' => $this->is_open_now,
            'latitude' => $this->lat,
            'longitude' => $this->lng,
            'distance' => $formattedDistance,
            'opening_hours' => OpeningHoursResource::collection($this->whenLoaded('openingHours')),
        ];
    }
}
