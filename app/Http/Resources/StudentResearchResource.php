<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResearchResource extends JsonResource
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
            'program' => $this->program,
            'date' => $this->date,
            'title' => $this->title,
            'teacher_name' => $this->teacher_name,
            'teacher_lname' => $this->teacher_lname,
            'uname' => $this->uname,
            'attachment_path' => $this->attachment_path,
        ];
    }
}
