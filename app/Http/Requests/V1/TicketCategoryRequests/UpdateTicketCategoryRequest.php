<?php

namespace App\Http\Requests\V1\TicketCategoryRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //TODO - authorization
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
                'name' => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string', 'max:255'],
            ];
        } elseif($this->method() == 'PATCH'){
            return [
                'name' => ['sometimes', 'required', 'string', 'max:100'],
                'description' => ['sometimes', 'nullable', 'string', 'max:255'],
            ];
        }
    }
}
