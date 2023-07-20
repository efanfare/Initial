<?php

namespace App\Http\Requests;

use App\Models\Package;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('package_edit');
    }

    public function rules()
    {
        return [
            'package_name' => [
                'string',
                'required',
            ],
            'price_monthly' => [
                'numeric',
                'required',
            ],
            'price_yearly' => [
                'numeric',
                'required',
            ],
            'options' => [
                'string',
                'nullable',
            ],
            'yearly_discount' => [
                'numeric',
                'required',
            ],
            'scene_limit' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'item_limit' => [
                'string',
                'nullable',
            ],
        ];
    }
}
