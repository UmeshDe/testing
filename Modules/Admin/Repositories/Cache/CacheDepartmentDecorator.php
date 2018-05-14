<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\DepartmentRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheDepartmentDecorator extends BaseCacheDecorator implements DepartmentRepository
{
    public function __construct(DepartmentRepository $department)
    {
        parent::__construct();
        $this->entityName = 'admin.departments';
        $this->repository = $department;
    }
}
