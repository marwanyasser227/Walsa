<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //! 001 => Make an permisson to user to use this request

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //! 002 => return the requirements to the function that call this request or use it

        return [
            'email' => 'email|required|unique:users',
            'password' => 'min_digits:8|confirmed',
            'phone' => 'required|unique:users|numeric|max_digits:11',
            'name' => 'required |string'

        ];
    }
}
