<?php

namespace App\Http\Requests\V1\CustomerPhoneRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerPhoneRequest extends FormRequest
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
        return [
            'customerId' => ['required', 'int', 'exists:customers,id'],
            //TODO phone number validation
            'phone' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:100'],
            'tags' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if(!empty($this->customerId)){
            $this->merge(['customer_id' => $this->customerId]);
        }
    }
}
