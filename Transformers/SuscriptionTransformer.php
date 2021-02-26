<?php

namespace Modules\Subscription\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\User\Transformers\UserProfileTransformer;

class SuscriptionTransformer extends Resource
{
    public function toArray($request)
    {

        $data = [
          'id' => $this->id,
          'initDate' => $this->init_date ?? '',
          'endDate' => $this->end_date ?? '',
          'total' => $this->total ?? '',
          'planId' => $this->plan_id ?? '',
          'userId' => $this->user_id ?? '',
          'status' => subscription__getStatus()->get($this->status) ?? '',
          'user' => new UserProfileTransformer($this->whenLoaded('user')),
          'plan' => new PlanTransformer($this->whenLoaded('plan')),
          'createdAt' => $this->when($this->created_at, $this->created_at),
          'updatedAt' => $this->when($this->updated_at, $this->updated_at),
        ];

        return $data;
    }
}
