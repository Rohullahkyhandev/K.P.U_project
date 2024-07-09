<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCommitteeResource extends JsonResource
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
            'director' => $this->director,
            'faculty' => $this->faculty,
            'metting_place' => $this->metting_place,
            'secretary' => $this->secretary,
            'secretary_phone' => $this->secretary_phone,
            'metting_per_month' => $this->metting_per_month,
            'director_phone' => $this->director_phone,
            'uname' => $this->uname,
        ];
    }
}
