<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramsResource extends JsonResource
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
            'program_name' => $this->program_name,
            'degree_type' => $this->degree_type,
            'program_duration' => $this->program_duration,
            'description' => $this->description,
            'uname' => $this->uname,
        ];
    }
}
