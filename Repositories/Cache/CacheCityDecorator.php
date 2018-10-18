<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Ilocations\Repositories\CityRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCityDecorator extends BaseCacheDecorator implements CityRepository
{
    public function __construct(CityRepository $city)
    {
        parent::__construct();
        $this->entityName = 'ilocations.cities';
        $this->repository = $city;
    }
}
