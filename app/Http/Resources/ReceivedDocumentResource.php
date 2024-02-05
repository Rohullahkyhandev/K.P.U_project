<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceivedDocumentResource extends JsonResource
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
            'source' => $this->source,
            'destination' => $this->destination,
            'remark' => $this->remark,
            'description' => $this->description,
            'iqdam_no' => $this->iqdam_no,
            'pages_no' => $this->pages_no,
            'volume' => $this->volume,
            'entered_no' => $this->entered_no,
            'date_of_entered' => $this->date_of_entered,
            'document_date' => $this->document_date,
            'attachment_path' => $this->attachment_path,
            'uname' => $this->uname
        ];
    }
}
