<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'fullName' => $this->full_name,
            'taxId' => $this->tax_id,
            'licenceNumber' => $this->licence_number,
            'emails' => new CustomerEmailCollection($this->whenLoaded('emails')),
            'phones' => new CustomerPhoneCollection($this->whenLoaded('phones')),
            'supportTickets' => new SupportTicketCollection($this->whenLoaded('tickets')),
        ];
    }
}
