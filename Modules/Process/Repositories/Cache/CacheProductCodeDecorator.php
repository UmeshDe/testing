<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\ProductCodeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProductCodeDecorator extends BaseCacheDecorator implements ProductCodeRepository
{
    public function __construct(ProductCodeRepository $productcode)
    {
        parent::__construct();
        $this->entityName = 'process.productcodes';
        $this->repository = $productcode;
    }
}
