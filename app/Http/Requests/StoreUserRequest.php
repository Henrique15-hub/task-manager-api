<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>[
                'required',
                'min:3',
                'max:255',
                'string'
            ],

            'email' => [
                'required',
                'max:255',
                'string',
                'unique:users'
            ],

            'password' => [
                'required',
                'min:6',
                'max:255',
            ]
        ];
    }
}
