<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\ShipmentFileRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheShipmentFileDecorator extends BaseCacheDecorator implements ShipmentFileRepository
{
    public function __construct(ShipmentFileRepository $shipmentfile)
    {
        parent::__construct();
        $this->entityName = 'process.shipmentfiles';
        $this->repository = $shipmentfile;
    }
}
