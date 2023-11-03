<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorRequest extends FormRequest
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
            'company_name' => 'string|required',
            'contact_name' => 'string|nullable',
            'email' => 'string|unique:vendors',
            'phone' => 'string|max:12|nullable',
            'address' => 'string|required',
            'city' => 'string|required',
            'postcode'=>'string|required',
            'country' => 'string|required'

        ];
    }
}
