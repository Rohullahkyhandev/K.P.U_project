<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardMemberResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'board_name' => $this->board_name,
            'uname' => $this->uname,
        ];
    }
}
