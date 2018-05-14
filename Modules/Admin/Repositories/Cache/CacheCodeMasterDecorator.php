<?php

namespace Modules\Admin\Repositories\Cache;

use Modules\Admin\Repositories\CodeMasterRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCodeMasterDecorator extends BaseCacheDecorator implements CodeMasterRepository
{
    public function __construct(CodeMasterRepository $codemaster)
    {
        parent::__construct();
        $this->entityName = 'admin.codemasters';
        $this->repository = $codemaster;
    }
}
