<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'state' => 'nullable|string|max:25',
            'isTakeaway' => 'nullable|boolean',
            'total' => 'nullable|numeric|between:0,9999999999.99',
            'customer_id' => 'nullable|numeric',
            'address_id' => 'nullable|numeric',
            'restaurant_id' => 'nullable|numeric',
            'employee_id' => 'nullable|numeric',
        ];
    }
}
