<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class updateTask extends FormRequest
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
                'min:3',
                'max:255',
            ],

            'hours' => [
                'nullable',
                'date_format:H:i',
            ],
        ];
    }
}
