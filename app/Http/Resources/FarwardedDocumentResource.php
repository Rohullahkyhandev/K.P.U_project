<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FarwardedDocumentResource extends JsonResource
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
            'attachment_path' => $this->attachment_path,
            'number' => $this->number,
            'title' => $this->title,
            'status' => $this->status,
            'uname' => $this->uname,
            // 'lname' => $this->lname,
            'photo_path' => $this->photo_path,
            'fname' => $this->fname,
            'cname' => $this->cname,
            'created_at' => $this->created_at,
        ];
    }
}
