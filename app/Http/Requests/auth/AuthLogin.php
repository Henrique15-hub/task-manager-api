<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthLogin extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
        ];
    }
}
