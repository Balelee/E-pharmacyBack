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
            "treated_count" => $this->treated_count,
            "pharmacy" => new PharmacyResource($this->whenLoaded('pharmacy')),
            "status" => $this->status,
            "details" => OrderPharmacyDetailResource::collection($this->whenLoaded('orderpharmacydetails')),
        ];
    }
}
