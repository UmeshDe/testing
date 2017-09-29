<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\BagcolorRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBagcolorDecorator extends BaseCacheDecorator implements BagcolorRepository
{
    public function __construct(BagcolorRepository $bagcolor)
    {
        parent::__construct();
        $this->entityName = 'admin.bagcolors';
        $this->repository = $bagcolor;
    }
}
