<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
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
            'secretary' => $this->secretary,
            'secretary_phone' => $this->secretary_phone,
            'director' => $this->director,
            'director_phone' => $this->director_phone,
            'metting_place' => $this->metting_place,
            'metting_per_month' => $this->metting_per_month,
            'uname' => $this->uname,
        ];
    }
}
