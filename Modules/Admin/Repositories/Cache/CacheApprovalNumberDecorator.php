<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\ApprovalNumberRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheApprovalNumberDecorator extends BaseCacheDecorator implements ApprovalNumberRepository
{
    public function __construct(ApprovalNumberRepository $approvalnumber)
    {
        parent::__construct();
        $this->entityName = 'admin.approvalnumbers';
        $this->repository = $approvalnumber;
    }
}
