<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabResource extends JsonResource
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
            'experiment' => $this->experiment,
            'program_name' => $this->program_name,
            'establishment_date' => $this->establishment_date,
            'description' => $this->description,
            'uname' => $this->uname,
        ];
    }
}
