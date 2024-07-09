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
            'current_place' => $this->current_place,
            'main_place' => $this->main_place,
            'hire_date' => $this->hire_date,
            'salary' => $this->salary,
            'position' => $this->position,
            'nic' => $this->nic,
            'status' => $this->status,
            'uname' => $this->uname,

        ];
    }
}
