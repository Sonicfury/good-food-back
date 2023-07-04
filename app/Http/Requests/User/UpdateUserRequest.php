<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'nullable|string|email|unique:users',
            'firstname' => 'nullable|string|min:1|max:25',
            'lastname' => 'nullable|string|min:1|max:25',
            'phone' => ['nullable', 'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/'],
            'birthDate' => 'nullable|date',
            'restaurant_id' => 'nullable|numeric',
            'role' => 'nullable|string'
        ];
    }
}
