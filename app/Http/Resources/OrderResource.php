<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\OrderDetailResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'pharmacy_id' => $this->pharmacy_id,
            'orderStatus' => $this->orderStatus,
            'priceTotal' => $this->priceTotal,
            'orderStatusLabel' => $this->orderStatus->label(),
            'orderStatusColor' => $this->orderStatus->color(),
            'details' => OrderDetailResource::collection($this->details),
        ];
    }
}
