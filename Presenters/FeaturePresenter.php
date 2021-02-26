<?php

namespace Modules\Subscription\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Subscription\Entities\Type;

class FeaturePresenter extends Presenter
{
    /**
     * @var \Modules\Subscription\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Subscription\Entities\Status
     */
    protected $type;
    /**
     * @var \Modules\Subscription\Repositories\FeatureRepository
     */
    private $feature;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->feature = app('Modules\Subscription\Repositories\FeatureRepository');
        $this->type= app('Modules\Subscription\Entities\Type');
    }


   public function status()
    {

        return $this->entity->active?trans('subscription::common.form.active'):trans('subscription::common.form.inactive');

    }
    public function type()
    {
        return $this->type->get($this->entity->type);

    }


    public function statusLabelClass()
    {
        if ($this->entity->active) {
            return 'bg-green';
        }else {
            return 'bg-red';
        }

    }
    public function fields(): string
    {
        switch ($this->entity->type) {
            case Type::QUANTITY:
                return "quantity-field";
                break;
            case Type::TEXT:
                return 'text-field';
                break;
            case Type::BOOLEAN:
                return 'boolean-field';
                break;
        }
    }

}
