<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaculteisResource extends JsonResource
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
            'date' => $this->date,
            'description' => $this->description,
            'director_name' => $this->director_name,
            'director_lname' => $this->director_lname,
            'photo' => $this->photo,
            'photo_path' => $this->photo_path
        ];
    }
}
