<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class storeTask extends FormRequest
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
                'required',
                'string',
                'max:255',
                'min:3',
            ],

            'hours' => [
                'required',
                'date_format:H:i',
            ],
        ];
    }
}
