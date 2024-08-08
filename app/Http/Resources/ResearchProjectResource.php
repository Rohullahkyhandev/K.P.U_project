<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResearchProjectResource extends JsonResource
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
            'project_name' => $this->project_name,
            'scope_of_project' => $this->scope_of_project,
            'description' => $this->description,
            'date' => $this->date,
            'lab_name' => $this->lab_name,
            'related_image_path' => $this->related_image_path,
            'uname' => $this->uname,
        ];
    }
}
