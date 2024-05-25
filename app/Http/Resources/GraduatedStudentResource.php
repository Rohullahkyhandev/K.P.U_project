<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GraduatedStudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'lname' => $this->lname,
            'fname' => $this->fname,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'program_id' => $this->program_id,
            'nic' => $this->nic,
            'kankor_id' => $this->kankor_id,
            'kankor_mark' => $this->kankor_mark,
            'bachelor_field' => $this->bachelor_field,
            'status' => $this->status,
            'admission_year' => $this->admission_year,
            'blood_group' => $this->blood_group,
            'uname' => $this->uname,
        ];
    }
}
