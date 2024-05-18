<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherInSchalarshipResource extends JsonResource
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
            'country_name' => $this->country_name,
            'edu_degree' => $this->edu_degree,
            'edu_maqta' => $this->edu_maqta,
            'sent_date' => $this->sent_date,
            'back_date' => $this->back_date,
            'document_path' => $this->document_path,
            'teacher_id' => $this->teacher,
            'faculty' => $this->faculty,
            'department' => $this->department_id,
            'uname' => $this->uname,
        ];
    }
}
