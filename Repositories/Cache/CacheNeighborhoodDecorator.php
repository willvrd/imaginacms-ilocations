<?php

namespace Modules\Ilocations\Repositories\Cache;

use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Modules\Ilocations\Repositories\NeighborhoodRepository;

class CacheNeighborhoodDecorator extends BaseCacheDecorator implements NeighborhoodRepository
{
    public function __construct(NeighborhoodRepository $neighborhood)
    {
        parent::__construct();
        $this->entityName = 'ilocations.neighborhoods';
        $this->repository = $neighborhood;
    }

    /**
     * Get all the read notifications for the given filters
     */
    public function getItemsBy($params)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember(
                "{$this->locale}.{$this->entityName}.getItemBy",
                $this->cacheTime,
                function () use ($params) {
                    return $this->repository->getItemsBy($params);
                }
            );
    }

    /**
     * Get the read notification for the given filters
     */
    public function getItem($criteria, $params = false)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember(
                "{$this->locale}.{$this->entityName}.getItem",
                $this->cacheTime,
                function () use ($criteria, $params) {
                    return $this->repository->getItem($criteria, $params);
                }
            );
    }
}
