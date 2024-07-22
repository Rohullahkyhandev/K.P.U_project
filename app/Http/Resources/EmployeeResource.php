<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'program_name' => $this->program_name,
            'current_address' => $this->current_address,
            'main_address' => $this->main_address,
            'hire_date' => $this->hire_date,
            'salary' => $this->salary,
            'position' => $this->position,
            'nic' => $this->nic,
            'gender' => $this->gender,
            'photo_path' => $this->photo_path,
            'status' => $this->status,
            'uname' => $this->uname,
            'part_name' => $this->part_name,

        ];
    }
}
