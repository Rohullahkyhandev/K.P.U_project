<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCriteriaResource extends JsonResource
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
            'main_number' => $this->main_number,
            'number' => $this->number,
            'year' => $this->year,
            'attachment_path' => $this->attachment_path,
            'description' => $this->description,
            'related_part' => $this->related_part,
            'uname' => $this->uname,
        ];
    }
}
