<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusTerminalResource extends JsonResource
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
            'origin' => $this->origin_id ,
            'destination' => $this->destination_id ,
            'name' => $this->name,
            'terminal_code' => $this->terminal_code,
            'created_at' => $this->created_at->toDateTimeString(),  // تاریخ و زمان ایجاد
            'updated_at' => $this->updated_at->toDateTimeString(),  // تاریخ و زمان آخرین بروزرسانی
        ];
    }
}
