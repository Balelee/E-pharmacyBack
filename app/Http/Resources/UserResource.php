<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'userName' => $this->userName,
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'phone' => $this->phone,
            'birthDate' => $this->birthDate->format('d-m-Y'),
            'birthPlace' => $this->birthPlace,
            'email' => $this->email,
            'userType' => $this->userType,
            'userTypeLabel' => $this->userType->label(),
            'token' => $this->token,

        ];
    }
}
