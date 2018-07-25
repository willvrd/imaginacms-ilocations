<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Ilocations\Repositories\CountryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCountryDecorator extends BaseCacheDecorator implements CountryRepository
{
    public function __construct(CountryRepository $country)
    {
        parent::__construct();
        $this->entityName = 'ilocations.countries';
        $this->repository = $country;
    }
}
