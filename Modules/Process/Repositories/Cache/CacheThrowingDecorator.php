<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\ThrowingRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheThrowingDecorator extends BaseCacheDecorator implements ThrowingRepository
{
    public function __construct(ThrowingRepository $throwing)
    {
        parent::__construct();
        $this->entityName = 'process.throwings';
        $this->repository = $throwing;
    }
}
