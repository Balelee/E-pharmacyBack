<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpeningHoursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'day' => $this->day,
            'opening_time' => substr($this->opening_time, 0, 5),
            'closing_time' => substr($this->closing_time, 0, 5),
        ];
    }
}
