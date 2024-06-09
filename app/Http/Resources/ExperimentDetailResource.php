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
            'scope_part' => $this->scope_part,
            'related_image_paths' => is_array($this->related_image_paths) ? $this->related_image_paths : json_decode($this->related_image_paths, true),
        ];
    }
}
