<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Modules\Ilocations\Repositories\GeozonesRepository;

class CacheGeozonesDecorator extends BaseCacheDecorator implements GeozonesRepository
{
    public function __construct(GeozonesRepository $geozones)
    {
        parent::__construct();
        $this->entityName = 'ilocations.geozones';
        $this->repository = $geozones;
    }

  public function getAll()
  {
      return $this->remember(function () {
          return $this->repository->getAll();
      });
  }

  public function getItemsBy($params)
  {
      return $this->remember(function () use ($params) {
          return $this->repository->getItemsBy($params);
      });
  }

  public function getItem($criteria, $params = false)
  {
      return $this->remember(function () use ($criteria, $params) {
          return $this->repository->getItem($criteria, $params);
      });
  }
}
