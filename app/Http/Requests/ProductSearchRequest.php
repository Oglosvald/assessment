<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'q' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'q.string' => 'The parameter must be a string.',
            'q.max' => 'The parameter may not be greater than 255 characters.',
        ];        
    }
}
