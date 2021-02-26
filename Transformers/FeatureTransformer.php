<?php

namespace Modules\Subscription\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FeatureTransformer extends Resource
{
    public function toArray($request)
    {

        $data = [
          'id' => $this->id,
          'name' => $this->name ?? '',
          'description' => $this->description ?? '',
          'caption' => $this->caption ?? '',
          'status' => subscription__getStatus()->get($this->status) ?? '',
          'type' => subscription__getType()->get($this->type) ?? '',
          'unit' => $this->unit ?? '',
          'options' => $this->options ?? '',
          'product' => new ProductTransformer($this->whenLoaded('product')),
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
