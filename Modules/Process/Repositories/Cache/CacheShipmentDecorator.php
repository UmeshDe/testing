<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\ShipmentRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheShipmentDecorator extends BaseCacheDecorator implements ShipmentRepository
{
    public function __construct(ShipmentRepository $shipment)
    {
        parent::__construct();
        $this->entityName = 'process.shipments';
        $this->repository = $shipment;
    }
}
