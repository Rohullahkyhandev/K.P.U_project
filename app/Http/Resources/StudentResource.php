<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'fname' => $this->fname,
            'lname' => $this->lname,
            'phone' => $this->phone,
            'email' => $this->email,
            'kankor_id' => $this->kankor_id,
            'kankor_mark' => $this->kankor_mark,
            'bachelor_field' => $this->bachelor_field,
            'status' => $this->status,
            'nic' => $this->nic,
            'address' => $this->address,
            'admission_year' => $this->admission_year,
            'blood_group' => $this->blood_group,
            'program_name' => $this->program_name,
            'uname' => $this->uname,
        ];
    }
}
