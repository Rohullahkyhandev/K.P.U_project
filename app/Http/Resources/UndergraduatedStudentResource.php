<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UndergraduatedStudentResource extends JsonResource
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
            'email' => $this->email,
            'kankor_id' => $this->kankor_id,
            'kankor_mark' => $this->kankor_mark,
            'bachelor_field' => $this->bachelor_field,
            'status' => $this->status,
            'nic' => $this->nic,
            'address' => $this->address,
            'admission_year' => $this->admission_year,
        ];
    }
}
