<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheFishTypeDecorator extends BaseCacheDecorator implements FishTypeRepository
{
    public function __construct(FishTypeRepository $fishtype)
    {
        parent::__construct();
        $this->entityName = 'admin.fishtypes';
        $this->repository = $fishtype;
    }
}
