<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\RepackRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRepackDecorator extends BaseCacheDecorator implements RepackRepository
{
    public function __construct(RepackRepository $repack)
    {
        parent::__construct();
        $this->entityName = 'process.repacks';
        $this->repository = $repack;
    }
}
