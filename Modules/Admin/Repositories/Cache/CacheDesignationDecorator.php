<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\DesignationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheDesignationDecorator extends BaseCacheDecorator implements DesignationRepository
{
    public function __construct(DesignationRepository $designation)
    {
        parent::__construct();
        $this->entityName = 'admin.designations';
        $this->repository = $designation;
    }
}
