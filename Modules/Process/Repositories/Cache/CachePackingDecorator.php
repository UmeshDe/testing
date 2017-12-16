<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\PackingRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePackingDecorator extends BaseCacheDecorator implements PackingRepository
{
    public function __construct(PackingRepository $packing)
    {
        parent::__construct();
        $this->entityName = 'process.packings';
        $this->repository = $packing;
    }
}
