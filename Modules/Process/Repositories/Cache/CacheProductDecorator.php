<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\ProductRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProductDecorator extends BaseCacheDecorator implements ProductRepository
{
    public function __construct(ProductRepository $product)
    {
        parent::__construct();
        $this->entityName = 'process.products';
        $this->repository = $product;
    }
}
