<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PDC_CommitRsource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "topic" => $this->topic,
            "name" => $this->name,
            "date" => $this->date,
            "description" => $this->description,
            "attachment_path" => $this->attachment_path,
            "uname" => $this->uname,
        ];
    }
}
