<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
            'dateOrder' => $this->dateOrder->format('d-m-Y'),
            'orderStatus' => $this->orderStatus,
            'orderStatusLabel' => $this->orderStatus->label(),
        ];
    }
}
