<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'mobile_number' => 'required|max:255|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
