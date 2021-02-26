<?php

namespace Modules\Subscription\Presenters;

use Laracasts\Presenter\Presenter;

class ProductPresenter extends Presenter
{

    /**
     * @var \Modules\Subscription\Repositories\ProductRepository
     */
    private $product;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->product = app('Modules\Subscription\Repositories\ProductRepository');
    }

    /**
     * Get the previous post of the current post
     * @return object
     *
     * public function previous()
     * {
     * return $this->post->getPreviousOf($this->entity);
     * }
     */
    /**
     * Get the next post of the current post
     * @return object
     *
     * public function next()
     * {
     * return $this->post->getNextOf($this->entity);
     * }
     */
    /**
     * Get the post status
     * @return string
     */
    public function status()
    {
        return $this->entity->active ? trans('subscription::common.form.active') : trans('subscription::common.form.inactive');

    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        if ($this->entity->active) {
            return 'bg-green';
        } else {
            return 'bg-red';
        }
    }

}
