<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Ilocations\Repositories\ProvinceRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProvinceDecorator extends BaseCacheDecorator implements ProvinceRepository
{
    public function __construct(ProvinceRepository $province)
    {
        parent::__construct();
        $this->entityName = 'ilocations.provinces';
        $this->repository = $province;
    }
}
