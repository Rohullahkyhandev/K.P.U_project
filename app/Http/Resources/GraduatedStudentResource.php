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
            'thesis_mark' => $this->thesis_mark,
            'program_name' => $this->program_name,
            'thesis_guide_teacher' => $this->thesis_guide_teacher,
            'percenrage' => $this->percenrage,
            'diploma_id' => $this->diploma_id,
            'graduation_year' => $this->graduation_year,
            'status' => $this->status,
            'uname' => $this->uname,
        ];
    }
}
