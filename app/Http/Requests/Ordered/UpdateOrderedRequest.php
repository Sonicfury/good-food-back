<?php

namespace App\Http\Requests\Ordered;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderedRequest extends FormRequest
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
            'comment' => 'nullable|string|max:255',
            'quantity' => 'nullable|numeric',
            'product_id' => 'nullable|numeric',
            'menu_id' => 'nullable|numeric',
            'order_id' => 'nullable|numeric',
        ];
    }
}
