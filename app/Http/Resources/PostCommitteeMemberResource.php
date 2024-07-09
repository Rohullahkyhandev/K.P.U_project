<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCommitteeMemberResource extends JsonResource
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
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'commit_name' => $this->commit_name,
            'faculty' => $this->faculty,
            'uname' => $this->uname,
        ];
    }
}
