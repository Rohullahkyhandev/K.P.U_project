<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'manger_name' => $this->manger_name,
            'manager_lname' => $this->manager_lname,
            'photo_path' => $this->photo_path,
            'date' => substr($this->date, 0, 4) . ' ه,ش',
            'description' => $this->description,
            'fname' => $this->fname,
        ];
    }
}
