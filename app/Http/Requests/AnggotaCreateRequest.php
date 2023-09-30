<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggotaCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guard('ketua-api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'username' => 'required|string|min:4|unique:anggotas,username',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:anggotas,email',
            'phone' => 'required|numeric',
            // 'ketua_id' => 'required|exists:ketuas,id',
        ];
    }
}
