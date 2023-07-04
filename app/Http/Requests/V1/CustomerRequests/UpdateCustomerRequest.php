<?php

namespace App\Http\Requests\V1\CustomerRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //TODO - Add authentification
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
                'fullName' => ['nullable', 'string', 'max:255'],
                'taxId' => ['nullable', 'string', 'max:16'],
                'licenceNumber' => ['nullable', 'string', 'max:15', 'unique:customers,licence_number'],
            ];
        } elseif($this->method() == 'PATCH'){
            return [
                'name' => ['sometimes', 'required', 'string', 'max:100'],
                'fullName' => ['sometimes', 'nullable', 'string', 'max:255'],
                'taxId' => ['sometimes', 'nullable', 'string', 'max:16'],
                'licenceNumber' => ['sometimes', 'nullable', 'string', 'max:15', 'unique:customers,licence_number'],
            ];
        }
        
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if(!empty($this->fullName)){
            $this->merge(['full_name' => $this->fullName]);
        }
        if(!empty($this->taxId)){
            $this->merge(['tax_id' => preg_replace('/\s+/', '', $this->taxId)]);
        }
        if(!empty($this->licenceNumber)){
            $this->merge(['licence_number' => $this->licenceNumber]);
        }
    }
}
