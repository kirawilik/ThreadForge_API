<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blueprint_id' => [
                'required',
                'integer',
                'exists:blueprints,id',
            ],
            'raw_content' => [
                'required',
                'string',
                'min:10',
            ],
        ];
    }
}