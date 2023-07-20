<?php

namespace App\Http\Requests;

use App\Models\Scene;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSceneRequest extends FormRequest
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
            'description' => [
                'required',
                'string',
            ],
        ];
    }
}
