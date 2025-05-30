<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'full_name' => $this->full_name,
            'phone'  => $this->phone,
            'status'  => $this->status,
            'note'  => $this->note,
            'user'  => $this->user,
            'brands'  => $this->brands(),
        ];
    }
}
