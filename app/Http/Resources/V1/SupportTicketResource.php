<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportTicketResource extends JsonResource
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
            'customer' => $this->customer_id,
            'category' => $this->category_id,
            'createdBy' => $this->created_by,
            'closedBy' => $this->closed_by,
            'description' => $this->description,
            'customerContactType' => $this->customer_contact_type,
            'customerContact' => $this->customerContact,
        ];
    }
}
