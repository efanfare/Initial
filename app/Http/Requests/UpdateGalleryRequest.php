<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGalleryRequest extends FormRequest
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
            // 'cover_photo' => [
            //     'nullable',
            //     'mimes:jpeg,png,jpg,gif',
            //     'max:3072'
            // ],
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
