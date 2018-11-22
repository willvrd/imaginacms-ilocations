<?php

namespace Modules\Ilocations\Repositories\Eloquent;

use Modules\Ilocations\Repositories\ProvinceRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProvinceRepository extends EloquentBaseRepository implements ProvinceRepository
{
  public function index($page, $take, $filter, $include, $fields)
  {
   
    //Initialize Query
    $query = $this->model->query();
      $query->with('translations');
  
    
    /*== FILTER ==*/
    if ($filter) {
      if(isset($filter->country_id))
        $query->where("country_id",$filter->country_id);
    }
  
    /*== RELATIONSHIPS ==*/
      //Include relationships for default
      $includeDefault = [];
      $query->with(array_merge($includeDefault, $include));
   
  
    /*== FIELDS ==*/
      $defaultFields = ["id"];

      /*filter by user*/
      $query->select(array_merge($defaultFields, $fields));

    //Return request with pagination
    if ($page) {
      $take ? true : $take = 12; //If no specific take, query take 12 for default
      
      return $query->paginate($take);
    }
    
    //Return request without pagination
    if (!$page) {
      $take ? $query->take($take) : false; //if request to take a limit
      
      return $query->get()->sortBy('name');
      
    }
    
    
  }
  
  
  public function findByIso2($iso2){
    return $this->model->where('iso_2',$iso2)->first();
  }
}
