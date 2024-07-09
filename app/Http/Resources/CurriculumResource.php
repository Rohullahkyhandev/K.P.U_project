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
            'id' => $this->id,
            'subject_name' => $this->subject_name,
            'subject_code' => $this->subject_code,
            'subject_type' => $this->subject_type,
            'subject_credit' => $this->subject_credit,
            'semester' => $this->semester,
            'departments' => is_array($this->departments) ? $this->departments : json_decode($this->departments, true),
            'uname' => $this->uname
        ];
    }
}
