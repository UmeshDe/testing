<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\BuyercodeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBuyercodeDecorator extends BaseCacheDecorator implements BuyercodeRepository
{
    public function __construct(BuyercodeRepository $buyercode)
    {
        parent::__construct();
        $this->entityName = 'admin.buyercodes';
        $this->repository = $buyercode;
    }
}
