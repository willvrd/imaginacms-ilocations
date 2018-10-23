<?php

namespace Modules\Ilocations\Repositories\Eloquent;

use Modules\Ilocations\Repositories\CountryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCountryRepository extends EloquentBaseRepository implements CountryRepository
{
  
  public function index($page, $take, $filter, $include, $fields)
  {
    
    //Initialize Query
    $query = $this->model->query();
    $query->leftJoin('ilocations__country_translations','ilocations__countries.id', 'country_id');
    $query->where("locale","en");
  
    $query->where("status","<>","-1");
    /*== FILTER ==*/
    if ($filter) {
      
    }
    
    /*== RELATIONSHIPS ==*/
    if (count($include)) {
      //Include relationships for default
      $includeDefault = [];
    
      $query->with(array_merge($includeDefault, $include));
    }
  
    /*== FIELDS ==*/
    if ($fields) {
      $defaultFields = ["ilocations__countries.id","name"];
    
      /*filter by user*/
      $query->select(array_merge($defaultFields, $fields));
    
    }
  
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
