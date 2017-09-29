<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\EmployeeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheEmployeeDecorator extends BaseCacheDecorator implements EmployeeRepository
{
    public function __construct(EmployeeRepository $employee)
    {
        parent::__construct();
        $this->entityName = 'admin.employees';
        $this->repository = $employee;
    }
}
