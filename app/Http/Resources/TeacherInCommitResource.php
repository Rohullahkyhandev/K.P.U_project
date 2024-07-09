<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherInCommitResource extends JsonResource
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
            "name" => $this->name,
            "lname" => $this->lname,
            "email" => $this->email,
            "phone" => $this->phone,
            "commit_name" => $this->commit_name,
            "uname" => $this->uname,
            "cname" => $this->cname,
            "faculty_name" => $this->faculty_name,
            "department_name" => $this->department_name,
        ];
    }
}
