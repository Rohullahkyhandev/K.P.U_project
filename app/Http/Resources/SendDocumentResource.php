<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SendDocumentResource extends JsonResource
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
            'perform_branch' => $this->perform_branch,
            'attachment_branch' => $this->attachment_branch,
            'date_of_sent' => $this->date_of_sent,
            'document_date' => $this->document_date,
            'serial_no' => $this->serial_no,
            'pages_no ' => $this->pages_no,
            'volume' => $this->volume,
            'attachment_path' => $this->attachment_path,
            'uname' => $this->uname,
        ];
    }
}
