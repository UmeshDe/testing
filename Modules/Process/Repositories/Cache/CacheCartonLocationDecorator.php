<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCartonLocationDecorator extends BaseCacheDecorator implements CartonLocationRepository
{
    public function __construct(CartonLocationRepository $cartonlocation)
    {
        parent::__construct();
        $this->entityName = 'process.cartonlocations';
        $this->repository = $cartonlocation;
    }
}
