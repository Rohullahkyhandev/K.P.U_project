<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'fname' => $this->fatherName,
            'code_bast' => $this->code_bast,
            'education_field' => $this->education_field,
            'lname' => $this->lname,
            'faculty' => $this->faculty,
            'department' => $this->department,
            'email' => $this->email,
            'phone' => $this->phone,
            'hire_date' => $this->hire_date,
            'birth_date' => $this->birth_date,
            'education' => $this->education,
            'gender' => $this->gender,
            'academic_rank' => $this->academic_rank,
            // 'education' => $this->education,
            // 'last_rank' => $this->last_rank,
            'attachment_path' => is_array($this->attachment_path) ? $this->attachment_path : json_decode($this->attachment_path, true),
            'languages' => json_decode($this->languages, true),
            'now_rank' => $this->now_rank,
            'date' => $this->date,
            // 'status' => $this->status,
            // 'pname' => $this->pname,
            'degree_type' => $this->degree_type,
            // 'teaching_status' => $this->teaching_status,
            'edu_maqta' => $this->edu_maqta,
            'country' => $this->country,
            'sent_date' => $this->sent_date,
            'back_date' => $this->back_date,
            'uname' => $this->uname,

        ];
    }
}
