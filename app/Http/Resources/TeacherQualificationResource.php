<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherQualificationResource extends JsonResource
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
            'country' => $this->country,
            'education_' => $this->education_,
            'education_field' => $this->education_field,
            'graduated_year' => $this->graduated_year,
            'admission_year' => $this->admission_year,
            'university' => $this->university,
            'description' => $this->description,
            'uname' => $this->uname,
        ];
    }
}
