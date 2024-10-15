<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:products',
            'internal_notes' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'code.required' => 'The code is required.',
            'code.string' => 'The code must be a string.',
            'code.max' => 'The code may not be greater than 10 characters.',
            'code.unique' => 'The code has already been taken.',
            'internal_notes.string' => 'Internal notes must be a string.',
        ];
    }    
}