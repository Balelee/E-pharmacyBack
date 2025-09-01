<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPharmacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "order_id" => $this->order_id,
            "pharmacy_id" => $this->pharmacy_id,
            "status" => $this->status,
            "details" => OrderPharmacyDetailResource::collection($this->whenLoaded('orderpharmacydetails')),
        ];
    }
}
