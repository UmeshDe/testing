<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\TransferRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTransferDecorator extends BaseCacheDecorator implements TransferRepository
{
    public function __construct(TransferRepository $transfer)
    {
        parent::__construct();
        $this->entityName = 'process.transfers';
        $this->repository = $transfer;
    }
}
