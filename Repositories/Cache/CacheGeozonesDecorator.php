<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Ilocations\Repositories\GeozonesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheGeozonesDecorator extends BaseCacheDecorator implements GeozonesRepository
{
    public function __construct(GeozonesRepository $geozones)
    {
        parent::__construct();
        $this->entityName = 'ilocations.geozones';
        $this->repository = $geozones;
    }
}
