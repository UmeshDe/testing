<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\GradeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheGradeDecorator extends BaseCacheDecorator implements GradeRepository
{
    public function __construct(GradeRepository $grade)
    {
        parent::__construct();
        $this->entityName = 'admin.grades';
        $this->repository = $grade;
    }
}
