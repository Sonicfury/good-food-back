<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'name' => 'nullable|string|min:1|max:25',
            'main' => 'nullable|boolean',
            'address1' => 'nullable|string|min:1|max:255',
            'address2' => 'nullable|string|min:1|max:255',
            'zipCode' => 'nullable|string|min:2|max:5',
            'city' => 'nullable|string|min:1|max:25',
            'note' => 'nullable|string|min:1|max:255',
            'phone' => ['nullable', 'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/'],
            'user_id' => 'nullable|numeric',
        ];
    }
}
