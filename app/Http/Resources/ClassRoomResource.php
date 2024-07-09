<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassRoomResource extends JsonResource
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
            'number' => $this->number,
            'max_quantity' => $this->max_quantity,
            'equipment' => $this->equipment,
            'program_name' => $this->program_name,
            'uname' => $this->uname
        ];
    }
}
