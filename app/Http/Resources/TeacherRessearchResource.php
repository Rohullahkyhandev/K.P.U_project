<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherRessearchResource extends JsonResource
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
            'faculty' => $this->faculty,
            'department' => $this->department,
            'research_title' => $this->search_title,
            'academic_rank' => $this->academic_rank,
            'education_degree' => $this->education_degree,
            'uname' => $this->uname,
            'date' => $this->date,
        ];
    }
}
