<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'state' => 'string|max:25',
            'isTakeaway' => 'boolean',
            'total' => 'numeric|between:0,9999999999.99',
            'customer_id' => 'numeric',
            'address_id' => 'numeric',
            'restaurant_id' => 'numeric',
            'employee_id' => 'numeric',
        ];
    }
}
