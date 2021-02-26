<?php

namespace Modules\Subscription\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateFeatureRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'type'=>'required',
          'product_id'=>'required|exists:subscription__products,id',

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
