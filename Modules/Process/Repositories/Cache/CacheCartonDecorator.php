<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\CartonRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCartonDecorator extends BaseCacheDecorator implements CartonRepository
{
    public function __construct(CartonRepository $carton)
    {
        parent::__construct();
        $this->entityName = 'process.cartons';
        $this->repository = $carton;
    }
}
