<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->curriculum_id,
            'subject_name' => $this->subject_name,
            'subject_code' => $this->subject_code,
            'subject_type' => $this->subject_type,
            'subject_credit' => $this->subject_credit,
            'departments' => is_array($this->departments) ? array($this->departments) : $this->departments,
            'uname' => $this->uname
        ];
    }
}
