<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description','price'];
    protected $table = 'subscription__plan_translations';
}
