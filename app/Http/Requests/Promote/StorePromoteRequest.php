<?php

namespace App\Http\Requests\Promote;

use Illuminate\Foundation\Http\FormRequest;

class StorePromoteRequest extends FormRequest
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
            'name' => 'string|unique:promotes|max:25',
            'price' => 'numeric|between:1,99',
            'product_id' => 'numeric',
        ];
    }
}
