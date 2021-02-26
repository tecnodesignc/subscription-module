<?php

namespace Modules\Subscription\Presenters;

use Laracasts\Presenter\Presenter;

class PlanPresenter extends Presenter
{

    /**
     * @var \Modules\Subscription\Repositories\PlanRepository
     */
    private $plan;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->plan = app('Modules\Subscription\Repositories\PlanRepository');
    }

    /**
     * Get the post status
     * @return string
     */
    public function status()
    {
        return $this->entity->active?trans('subscription::common.form.active'):trans('subscription::common.form.inactive');

    }

    /**
     * Get the bill cycle
     * @return string
     */
    public function billCycle()
    {
        $billCycle="";
        if($this->entity->bill_cycle=="week"){
          $billCycle=trans("subscription::bill_cycles.cycles.weeks");
        }else if($this->entity->bill_cycle=="month"){
          $billCycle=trans("subscription::bill_cycles.cycles.months");
        }else if($this->entity->bill_cycle=="year"){
          $billCycle=trans("subscription::bill_cycles.cycles.years");
        }
        return $billCycle;
    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        if ($this->entity->active) {
            return 'bg-green';
        }else {
            return 'bg-red';
        }
    }
}
