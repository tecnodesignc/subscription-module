<?php

namespace Modules\Subscription\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\User\Transformers\UserProfileTransformer;

class ProductTransformer extends Resource
{
    public function toArray($request)
    {

        $data = [
          'id' => $this->id,
          'name' => $this->name ?? '',
          'description' => $this->description ?? '',
          'status' => subscription__getStatus()->get($this->status) ?? '',
          'options' => $this->options ?? '',
          'requireShippingAddress' => $this->require_shipping_address ?? '',
          'user' => new UserProfileTransformer($this->whenLoaded('user')),
          'plans' => PlanTransformer::collection($this->whenLoaded('plans')),
          'createdAt' => $this->when($this->created_at, $this->created_at),
          'updatedAt' => $this->when($this->updated_at, $this->updated_at),
        ];

        // TRANSLATIONS
        $filter = json_decode($request->filter);
        // Return data with available translations
        if (isset($filter->allTranslations) && $filter->allTranslations) {
          // Get langs avaliables
          $languages = \LaravelLocalization::getSupportedLocales();
          foreach ($languages as $lang => $value) {
            if ($this->hasTranslation($lang)) {
              $data[$lang]['name'] = $this->hasTranslation($lang) ?
                $this->translate("$lang")['name'] : '';
              $data[$lang]['description'] = $this->hasTranslation($lang) ?
                $this->translate("$lang")['description'] : '';
            }
          }
        }

        return $data;
    }
}
