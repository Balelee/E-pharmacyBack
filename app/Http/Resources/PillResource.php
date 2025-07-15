<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PillResource extends JsonResource
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
            'medicine_name' => $this->medicine_name,
            'start_date' => $this->start_date->format('d-m-Y'),
            'reminder_time' => substr($this->reminder_time, 0, 5),
            'form' =>$this->form,
            'frequency' => $this->frequency,
        ];
    }
}
