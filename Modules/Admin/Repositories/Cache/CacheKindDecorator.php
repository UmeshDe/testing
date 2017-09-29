<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\KindRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheKindDecorator extends BaseCacheDecorator implements KindRepository
{
    public function __construct(KindRepository $kind)
    {
        parent::__construct();
        $this->entityName = 'admin.kinds';
        $this->repository = $kind;
    }
}
