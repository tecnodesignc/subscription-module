<?php

namespace Modules\Subscription\Repositories\Eloquent;

use Modules\Subscription\Events\ProductWasCreated;
use Modules\Subscription\Events\ProductWasDeleted;
use Modules\Subscription\Events\ProductWasUpdated;
use Modules\Subscription\Repositories\ProductRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProductRepository extends EloquentBaseRepository implements ProductRepository
{


    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $product = $this->model->create($data);
        event(new ProductWasCreated($product, $data));
        return $product;
    }

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function update($model, $data)
    {
        $model->update($data);
        event(new ProductWasUpdated($model, $data));
        return $model;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function destroy($model)
    {
        event(new ProductWasDeleted($model));

        return $model->delete();
    }

    public function getItem($criteria,$params=false){
      // INITIALIZE QUERY
      $query = $this->model->query();

      /*== RELATIONSHIPS ==*/
      if(in_array('*',$params->include)){//If Request all relationships
        $query->with(['translations']);
      }else{//Especific relationships
        $includeDefault = ['translations'];//Default relationships
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

    public function getItemsBy($params=false)
    {

      // INITIALIZE QUERY
      $query = $this->model->query();

      /*== RELATIONSHIPS ==*/
      if(in_array('*',$params->include)){//If Request all relationships
        $query->with(['translations']);
      }else{//Especific relationships
        $includeDefault = ['translations'];//Default relationships
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


    /**
     * @param string $systemName
     * @return mixed
     */
    public function findBySystemName(string $systemName)
    {
        return $this->model->with('plans','translations')->where('system_name', '=', $systemName)->where('active', true)->first();
    }

}
