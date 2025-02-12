<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TerminalResource extends JsonResource
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
            'name' => $this->name,
            'terminal_code' => $this->terminal_code,
            'city_code' => $this->origin->city_code ?? null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];
    }
}
