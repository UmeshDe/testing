<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\TransferCartonRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTransferCartonDecorator extends BaseCacheDecorator implements TransferCartonRepository
{
    public function __construct(TransferCartonRepository $transfercarton)
    {
        parent::__construct();
        $this->entityName = 'process.transfercartons';
        $this->repository = $transfercarton;
    }
}
