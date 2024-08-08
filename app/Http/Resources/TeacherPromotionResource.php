<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherPromotionResource extends JsonResource
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
            'date' => $this->date,
            'last_rank' => $this->last_academic_rank,
            'now_rank' => $this->now_academic_rank,
            'attachment_path' => is_array($this->attachment_path) ? $this->attachment_path : json_decode($this->attachment_path, true),
        ];
    }
}
