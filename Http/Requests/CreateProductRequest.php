<?php

namespace Modules\Subscription\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
{
    public function rules()
    {
        return ['system_name'=>'required|min:2'];
    }

    public function translationRules()
    {
        return [
            'name'=>'required|min:2'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return ['system_name.required' => trans('subscription::messages.name is required'),
            'system_name.min2'=>trans('subscription::messages.name is min 2')];
    }

    public function translationMessages()
    {
        return [
            'name.required' => trans('subscription::messages.name is required'),
            'name.min2'=>trans('subscription::messages.name is min 2')
        ];
    }
}
