<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGalleryRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user() ? true : false;
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
            ],
            'scenes.*' => [
                'integer',
            ],
            'scenes' => [
                'required',
                'array',
            ],
        ];
    }

    public function messages()
    {
        return [
            'scenes.required' => 'Please select at least one scene.',
        ];
    }
}
