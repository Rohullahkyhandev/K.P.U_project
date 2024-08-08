<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperimentDetailResource extends JsonResource
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
            'experiment_name' => $this->experiment_name,
            'related_part' => $this->related_part,
            'standard_id' => $this->standard_id,
            'scope_part' => $this->scope_part,
            'related_image_path' => $this->related_image_path,
            'lab_name' => $this->lab_name,
            'uname' => $this->uname,
        ];
    }
}
