<?php

namespace Modules\Ilocations\Repositories\Eloquent;

use Modules\Ilocations\Repositories\GeozonesRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentGeozonesRepository extends EloquentBaseRepository implements GeozonesRepository
{
  public function getAll(){
    return $this->model->orderBy('name','asc')->get();
  }
  
 
}
