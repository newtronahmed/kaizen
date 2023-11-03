<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'color' => 'nullable',
            'size' => 'nullable',
            'unit' => 'nullable',
            'manufacturer' => 'nullable|string',
            'product_type' => 'nullable|string',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'initial_quantity' => 'required',
            'minimum_stock_level' => 'nullable|numeric',
            'maximum_stock_level' => 'nullable|numeric',
            'returnable' => 'nullable|boolean',
        ];
    }
}
