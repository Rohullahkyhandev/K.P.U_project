<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScholarshipResource extends JsonResource
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
            'faculty_id' => $this->faculty_id,
            'country_name' => $this->country_name,
            'edu_degree' => $this->edu_degree,
            'edu_maqta' => $this->edu_maqta,
            'sent_date' => $this->sent_date,
            'back_date' => $this->back_date,
            'document_path' => $this->document_path,
            'name' => $this->name,
            'lname' => $this->lname,
            'email' => $this->email,
            'faculty' => $this->faculty,
            'department' => $this->department,
            'uname' => $this->uname,
        ];
    }
}
