<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'product_id' => $this->product_id,
            'productName' => $this->product_name,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'statusLabel' => $this->status->label(),
            'statusColor' => $this->status->color() ?? '0xFFDC3545',
            'priceUnitaire' => $this->priceUnitaire,
            'productImage' => $this->path_url,
        ];
    }
}
