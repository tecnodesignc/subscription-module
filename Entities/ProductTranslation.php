<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description'];
    protected $table = 'subscription__product_translations';
}
