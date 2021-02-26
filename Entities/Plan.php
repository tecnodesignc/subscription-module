<?php

namespace Modules\Subscription\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Laracasts\Presenter\PresentableTrait;
use Modules\Order\Entities\CartItem;
use Modules\Subscription\Presenters\PlanPresenter;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;

class Plan extends Model
{
    use Translatable,MediaRelation, PresentableTrait, NamespacedEntity;

    protected $table = 'subscription__plans';
    public $translatedAttributes = ['name','description','price'];
    protected $fillable = [
      'code',
      'active',
      'display_order',
      'recommendation',
      'free',
      'visible',
      'frequency',
      'bill_cycle',
      'trial_period',
      'product_id',
      'options'
    ];
    protected $presenter = PlanPresenter::class;
    protected static $entityNamespace = 'encore/subscription';
    /**
     * The attributes that should be casted to native types
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'active' => 'boolean',
        'is_visible' => 'boolean',
        'free' => 'boolean',
    ];

    /**
     * relation ship Crops entities
     * @return mixed
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }


    public function features()
    {
        return $this->belongsToMany(Feature::class, 'subscription__plan_feature')->as('items')->withPivot('value', 'plan_caption')->withTimestamps();
    }
    public function cartItem()
    {
        return $this->morphOne(CartItem::class, 'itemmable');
    }
    /**
     * Get the thumbnail image for the current blog post
     * @return File|string
     */
    public function getIconAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'icon')->first();

        if (!$thumbnail) {
            $image = [
                'mimeType' => 'image/jpeg',
                'path' =>'https://via.placeholder.com/93x116.png'
            ];
        } else {
            $image = [
                'mimeType' => $thumbnail->mimetype,
                'path' => $thumbnail->path_string
            ];
        }
        return json_decode(json_encode($image));
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereActive(true);
    }

    /**
     * Check if the post is pending review
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query): Builder
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
        $config = implode('.', ['encore.subscription.config.plan.relations', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }


}
