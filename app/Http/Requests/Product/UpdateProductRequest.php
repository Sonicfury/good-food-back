<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;


class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|unique:products|max:25',
            'price' => 'nullable|numeric|between:0,9999999999.99',
            'category_id' => 'nullable|numeric',
        ];
    }
}
