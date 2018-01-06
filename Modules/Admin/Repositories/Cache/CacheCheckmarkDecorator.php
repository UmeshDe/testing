<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\CheckmarkRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCheckmarkDecorator extends BaseCacheDecorator implements CheckmarkRepository
{
    public function __construct(CheckmarkRepository $checkmark)
    {
        parent::__construct();
        $this->entityName = 'admin.checkmarks';
        $this->repository = $checkmark;
    }
}
