<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'pharmacieName' => $this->pharmacy_name,
            'productImage' => $this->image_url,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'type' => $this->type,
            'typeLabel' => $this->type->label(),
            'stock' => $this->stock,
            'laborator' => $this->laborator,
        ];
    }
}
