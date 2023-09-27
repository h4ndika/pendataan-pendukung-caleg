<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KetuaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()
            ->guard('admin-api')
            ->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'username' => 'string|min:4|unique:ketuas,username',
            'email' => 'email|unique:ketuas,email',
            'phone' => 'numeric',
        ];
    }
}
