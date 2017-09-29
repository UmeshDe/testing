<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\CartonTypeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCartonTypeDecorator extends BaseCacheDecorator implements CartonTypeRepository
{
    public function __construct(CartonTypeRepository $cartontype)
    {
        parent::__construct();
        $this->entityName = 'admin.cartontypes';
        $this->repository = $cartontype;
    }
}
