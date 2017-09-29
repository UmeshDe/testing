<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\QualityParameterRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheQualityParameterDecorator extends BaseCacheDecorator implements QualityParameterRepository
{
    public function __construct(QualityParameterRepository $qualityparameter)
    {
        parent::__construct();
        $this->entityName = 'process.qualityparameters';
        $this->repository = $qualityparameter;
    }
}
