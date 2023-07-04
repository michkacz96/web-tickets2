<?php

namespace App\Http\Requests\V1\CustomerRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:100'],
            'fullName' => ['nullable', 'string', 'max:255'],
            'taxId' => ['nullable', 'string', 'max:16'],
            'licenceNumber' => ['nullable', 'string', 'max:15', 'unique:customers,licence_number'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if(!empty($this->fullName)){
            $this->merge(['full_name' => $this->fullName]);
        } else{
            $this->merge(['full_name' => $this->name]);
        }
        if(!empty($this->taxId)){
            $this->merge(['tax_id' => $this->taxId]);
        }
        if(!empty($this->licenceNumber)){
            $this->merge(['licence_number' => $this->licenceNumber]);
        }
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $this->replace([
            'name' => $this->name,
            'full_name' => $this->full_name,
            'tax_id' => preg_replace('/\s+/', '', $this->tax_id),
            'licence_number' => preg_replace('/\s+/', '', $this->licence_number),
        ]);
    }
}
