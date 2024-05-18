<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherInWorkshopResource extends JsonResource
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
            'tanme' => $this->tname,
            'tlname' => $this->tlname,
            'temail' => $this->email,
            'topic' => $this->topic,
            'start_time' => $this->stat_time,
            'end_time' => $this->end_time,
            'document_path' => $this->document_path,
        ];
    }
}
