<?php

namespace Modules\Subscription\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Laracasts\Presenter\PresentableTrait;
use Modules\Subscription\Presenters\ProductPresenter;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;

class Product extends Model
{
    use Translatable,  MediaRelation, PresentableTrait, NamespacedEntity;

    protected $table = 'subscription__products';
    public $translatedAttributes = ['name','description'];
    protected $fillable = [
      'name',
      'description',
      'system_name',
      'require_shipping_address',
      'active',
      'user_id',
      'options'
    ];
    protected $presenter = ProductPresenter::class;
    protected static $entityNamespace = 'encore/subscription';
    /**
     * The attributes that should be casted to native types
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'active' => 'boolean',
        'require_shipping_address'=>'boolean'
    ];

    /**
     * relation ship Crops entities
     * @return mixed
     */
    public function plans(){
        return $this->hasMany(Plan::class);
    }

    /**
     * relation ship Crops entities
     * @return mixed
     */
    public function features(){
        return $this->hasMany(Feature::class);
    }


    /**
     * relation ship User entity
     * @return mixed
     */
    public function user()
    {
        $driver = config('encore.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    /**
     * Get the thumbnail image for the current blog post
     * @return File|string
     */
    public function getMainImageAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'thumbnail')->first();

        if (!$thumbnail) {
            $image = [
                'mimeType' => 'image/jpeg',
                'path' =>null
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
        $config = implode('.', ['encore.subscription.config.product.relations', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }


}
