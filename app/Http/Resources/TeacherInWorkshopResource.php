<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherInWorkshopResource extends JsonResource
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
            'lname' => $this->lname,
            'email' => $this->email,
            'phone' => $this->phone,
            'topic' => $this->topic,
            'document_path' => $this->document_path,
            'uname' => $this->uname,
            'faculty_name' => $this->faculty_name,
            'department_name' => $this->department_name,
        ];
    }
}
