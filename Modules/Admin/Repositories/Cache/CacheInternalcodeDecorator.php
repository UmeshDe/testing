<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\InternalcodeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheInternalcodeDecorator extends BaseCacheDecorator implements InternalcodeRepository
{
    public function __construct(InternalcodeRepository $internalcode)
    {
        parent::__construct();
        $this->entityName = 'admin.internalcodes';
        $this->repository = $internalcode;
    }
}
