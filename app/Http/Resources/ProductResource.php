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
            'productName' => $this->productName,
            'description' => $this->description,
            'price' => $this->price,
            'productType' => $this->productType,
            'productTypeLabel' => $this->productType->label(),
            'stock' => $this->stock,
            'productType' => $this->productType,
            'expiredDate' => $this->expiredDate->format('d-m-Y'),
            'laborator' => $this->laborator,
        ];
    }
}
