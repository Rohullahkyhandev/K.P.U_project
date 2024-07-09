<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'title' => $this->title,
            'number' => $this->number,
            'source' => $this->source,
            'destination' => $this->destination,
            'date' => $this->date,
            'attachment_path' => $this->attachment_path,
            'remark' => $this->remark,
            'type' => $this->type,
            'uname' => $this->uname,
        ];
    }
}
