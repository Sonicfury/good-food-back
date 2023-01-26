<?php

namespace App\Http\Requests\Promote;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromoteRequest extends FormRequest
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
            'name' => 'nullable|string|unique:promotes|max:25',
            'price' => 'nullable|numeric|between:1,99',
            'product_id' => 'nullable|numeric',
        ];
    }
}
