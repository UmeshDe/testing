<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\RepackingRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRepackingDecorator extends BaseCacheDecorator implements RepackingRepository
{
    public function __construct(RepackingRepository $repacking)
    {
        parent::__construct();
        $this->entityName = 'process.repackings';
        $this->repository = $repacking;
    }
}
