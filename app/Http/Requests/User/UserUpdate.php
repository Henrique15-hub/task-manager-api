<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'max:255',
                'min:3',
            ],

            'email' => [
                'nullable',
                'max:255',
                'string',
                'email',
            ],

            'password' => [
                'required',
                'min:6',
                'max:255',
                'string',
            ],
        ];
    }
}
