<?php

namespace App\Http\Requests\V1\TicketDetailRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //TODO - authorization
        //User can only create, modify, delete tickets with action M - message
        //Only user who created message can edit it
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if($this->method() == 'PUT'){
            return [
                'ticketId' => ['required', 'integer', 'exists:support_tickets,id'],
                'userId' => ['required', 'integer', 'exists:users,id'],
                'message' => ['required', 'string'],
            ];
        }elseif($this->method() == 'PATCH'){
            return [
                'ticketId' => ['sometimes', 'required', 'integer', 'exists:support_tickets,id'],
                'userId' => ['sometimes', 'required', 'integer', 'exists:users,id'],
                'message' => ['sometimes', 'required', 'string'],
            ];
        }
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        //User can add only message
        $this->merge(['action' => 'M']);
        
        if(!empty($this->ticketId)){
            $this->merge(['ticket_id' => $this->ticketId]);
        }
        if(!empty($this->userId)){
            $this->merge(['user_id' => $this->userId]);
        }
    }
}
