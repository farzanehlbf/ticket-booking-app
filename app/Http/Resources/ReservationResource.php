<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reservation_id' => $this->id,
            'search_id' => $this->search_id,
            'passengers_count' => $this->passengers_count,
            'chair_numbers' => $this->chair_numbers,
            'expiry_time' => $this->expiry_time,
            'status' => $this->status,

        ];
    }
}
