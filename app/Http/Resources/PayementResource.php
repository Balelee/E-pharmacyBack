<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayementResource extends JsonResource
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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'methodPayement' => $this->methodPayement,
            'methodPayementLabel' => $this->methodPayement->label(),
            'status' => $this->status,
            'statusLabel' => $this->status->label(),
        ];
    }
}
