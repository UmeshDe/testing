<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\LocationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLocationDecorator extends BaseCacheDecorator implements LocationRepository
{
    public function __construct(LocationRepository $location)
    {
        parent::__construct();
        $this->entityName = 'admin.locations';
        $this->repository = $location;
    }
}
