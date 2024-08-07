<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'position' => $this->position,
            'user_type' => $this->user_type,
            'photo' => $this->photo,
            'photo_path' => $this->photo_path,
            'dname' => $this->dname,
            'department_name' => $this->department_name,
            'fname' => $this->fname,
        ];
    }
}
