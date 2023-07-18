<?php

namespace App\Http\Requests\V1\SupportTicketRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupportTicketRequest extends FormRequest
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
                'customerId' => ['required', 'int', 'exists:customers,id'],
                'categoryId' => ['required', 'int', 'exists:ticket_categories,id'],
                'createdBy' => ['required', 'int', 'exists:users,id'],
                'priority' => ['required', Rule::in(['L', 'M', 'H', 'U']),
                'description' => ['required', 'string', 'max:255'],
                'customerContactType' => ['required', Rule::in(['E', 'P'])],
                'customerContact' => ['required', 'string'],
            ];
        } elseif($this->method() == 'PATCH'){
            return [
                'customerId' => ['sometimes', 'required', 'int', 'exists:customers,id'],
                'categoryId' => ['sometimes', 'required', 'int', 'exists:ticket_categories,id'],
                'createdBy' => ['sometimes', 'required', 'int', 'exists:users,id'],
                'priority' => ['sometimes', 'required', Rule::in(['L', 'M', 'H', 'U']),
                'description' => ['sometimes', 'required', 'string', 'max:255'],
                'customerContactType' => ['sometimes', 'required', Rule::in(['E', 'P'])],
                'customerContact' => ['sometimes', 'required', 'string'],
            ];
        }
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if(!empty($this->customerId)){
            $this->merge(['customer_id' => $this->customerId]);
        }
        if(!empty($this->categoryId)){
            $this->merge(['category_id' => $this->categoryId]);
        }
        if(!empty($this->createdBy)){
            $this->merge(['created_by' => $this->createdBy]);
        }
        if(!empty($this->customerContactType)){
            $this->merge(['customer_contact_type' => $this->customerContactType]);
        }
        if(!empty($this->customerContact)){
            $this->merge(['customer_contact' => $this->customerContact]);
        }
    }
}
