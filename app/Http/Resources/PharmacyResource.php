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
        return [
            'id' => $this->id,
            'pharmacien_id' => $this->pharmacien_name,
            'pharmacieName' => $this->pharmacieName,
            'adresse' => $this->adresse,
            'phone' => $this->phone,
            'is_on_duty' => $this->is_on_duty,
            'is_open_now' => $this->is_open_now,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'opening_hours' => OpeningHoursResource::collection($this->whenLoaded('openingHours')),
        ];
    }
}
