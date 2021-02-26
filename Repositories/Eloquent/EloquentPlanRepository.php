<?php

namespace Modules\Subscription\Repositories\Eloquent;

use Modules\Subscription\Events\PlanWasCreated;
use Modules\Subscription\Events\PlanWasDeleted;
use Modules\Subscription\Events\PlanWasUpdated;
use Modules\Subscription\Repositories\PlanRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Support\Arr;

class EloquentPlanRepository extends EloquentBaseRepository implements PlanRepository
{
    /**
     * where by product
     * @param $product_id
     * @param int $perPage
     * @return mixed
     */
    public function whereProduct($product_id, $perPage = 15)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->where('product_id', $product_id)->orderBy('created_at', 'DESC')->paginate($perPage);
        }

        return $this->model->where('product_id', $product_id)->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    public function getItem($criteria, $params = false)
    {
        // INITIALIZE QUERY
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with([]);
        } else {//Especific relationships
            $includeDefault = ["translations"];//Default relationships
            if (isset($params->include))//merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);//Add Relationships to query
        }

        /*== FIELDS ==*/
        if (is_array($params->fields) && count($params->fields))
            $query->select($params->fields);


        /*== FILTER ==*/
        if (isset($params->filter)) {
            $filter = $params->filter;

            if (isset($filter->field))//Filter by specific field
                $field = $filter->field;
            // find by specific attribute or by id

            $query->where($field ?? 'id', $criteria);

        }//params->filter
        /*== REQUEST ==*/
        return $query->first();
    }//getItem($criteria,$request)

    public function getItemsBy($params = false)
    {

        // INITIALIZE QUERY
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with([]);
        } else {//Especific relationships
            $includeDefault = ["translations"];//Default relationships
            if (isset($params->include))//merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);//Add Relationships to query
        }

        // FILTERS
        if ($params->filter) {
            $filter = $params->filter;

            //Filter by date
            if (isset($filter->date)) {
                $date = $filter->date;//Short filter date
                $date->field = $date->field ?? 'created_at';
                if (isset($date->from))//From a date
                    $query->whereDate($date->field, '>=', $date->from);
                if (isset($date->to))//to a date
                    $query->whereDate($date->field, '<=', $date->to);
            }

            //Order by
            if (isset($filter->order)) {
                $orderByField = $filter->order->field ?? 'created_at';//Default field
                $orderWay = $filter->order->way ?? 'desc';//Default way
                $query->orderBy($orderByField, $orderWay);//Add order to query
            }

            //ProductId
            if (isset($filter->productId)) {
                $query->where('product_id', $filter->productId);
            }

        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
            $params->take ? $query->take($params->take) : false;//Take
            return $query->get();
        }
    }//getItemsBy

    public function create($data)
    {
        $plan = $this->model->create($data);
        event(new PlanWasCreated($plan,$data));
        if ($plan) {
            // sync tables
            $plan->features()->sync(Arr::get($data, 'features', []));

        }

        return $plan;
    }

    public function update($model, $data)
    {
        $plan = $model->update($data);
        event(new PlanWasUpdated($model, $data));
        if ($plan) {
            // sync tables
            $model->features()->sync(Arr::get($data, 'features', []));

        }

        return $model;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function destroy($model)
    {
        event(new PlanWasDeleted($model));

        return $model->delete();
    }
}
