<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;

class FeatureTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','caption','description'];
    protected $table = 'subscription__feature_translations';
}
