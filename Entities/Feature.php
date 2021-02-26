<?php

namespace Modules\Subscription\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Subscription\Presenters\FeaturePresenter;
use Modules\Core\Traits\NamespacedEntity;

class Feature extends Model
{
    use Translatable, PresentableTrait, NamespacedEntity;

    protected $table = 'subscription__features';
    public $translatedAttributes = ['name','caption', 'description'];
    protected $fillable = ['name','caption','description','active','unit','type','is_visible','product_id','options'];
    protected $presenter = FeaturePresenter::class;
    protected static $entityNamespace = 'encore/subscription';
    /**
     * The attributes that should be casted to native types
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'active' => 'boolean',
        'is_visible' => 'boolean',
    ];

    /**
     * relation ship Crops entities
     * @return mixed
     */
    public function plans(){
        return $this->belongsToMany(Plan::class,'subscription__plan_feature')->withPivot('value', 'plan_caption')->withTimestamps();
    }

    public function product(){

        return $this->belongsTo(Product::class);
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereActive(true);
    }

    /**
     * Check if the post is pending review
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query)
    {
        return $query->whereActive(false);
    }

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['encore.subscription.config.features.relations', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }


}
