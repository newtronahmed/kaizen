<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email_address' => ['required', 'string', 'unique:customers'],
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'avatar' => 'nullable|url',
            'website' => 'nullable|url',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',

        ];
    }

    public function failedValidation(Validator $validator) {
        throw new ValidationException($validator); 
      }
}
