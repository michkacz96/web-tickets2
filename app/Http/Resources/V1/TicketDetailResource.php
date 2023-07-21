<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketDetailResource extends JsonResource
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
            'ticketId' => $this->ticket_id,
            'action' => $this->action,
            'type' => $this->type,
            'message' => $this->message,
            'userId' => $this->user_id,
        ];
    }
}
