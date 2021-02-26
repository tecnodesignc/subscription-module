<?php

namespace Modules\Subscription\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreatePlanRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'code'=>'required',
          'frequency'=>'required',
          'bill_cycle'=>'required',
          'product_id'=>'required',
        ];
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
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
