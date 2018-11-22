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
    $query->with('translations');
    $query->where("status","<>","-1");
    /*== FILTER ==*/
    if ($filter) {
        if (isset($filter->search)) { //si hay que filtrar por rango de precio
            $criterion = $filter->search;
            $param = explode(' ', $criterion);
            $query->where(function ($query) use ($param) {
                foreach ($param as $index => $word) {
                    if ($index == 0) {
                        $query->where('name', 'like', "%" . $word . "%");
                        $query->orWhere('full name', 'like', "%" . $word . "%");
                    } else {
                        $query->orWhere('title', 'like', "%" . $word . "%");
                        $query->orWhere('sku', 'like', "%" . $word . "%");
                    }
                }

            });
        }
    }
    
    /*== RELATIONSHIPS ==*/
    if (count($include)) {
      //Include relationships for default
      $includeDefault = [];
    
      $query->with(array_merge($includeDefault, $include));
    }
  
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
