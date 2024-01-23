<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => intval($this->id),
            'date' => $this->date,
            'pocket1' => intval($this->pocket1),
            'pocket2'  => intval($this->pocket2),
            'pocket3'  => intval($this->pocket3),
        ];
    }
}
