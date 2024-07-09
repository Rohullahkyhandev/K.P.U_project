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
            'id' => $this->id,
            'name' => $this->name,
            'lname' => $this->lname,
            'fname' => $this->fname,
            'thesis_mark' => $this->thesis_mark,
            'program_name' => $this->program_name,
            'thesis_guide_teacher' => $this->thesis_guide_teacher,
            'percentage' => $this->percentage,
            'diplome_id' => $this->diplome_id,
            'graduated_year' => substr($this->graduated_year, 0, 5),
            'status' => $this->status,
            'uname' => $this->uname,
        ];
    }
}
