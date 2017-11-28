<?php

namespace Modules\Process\Repositories\Cache;

use Modules\Process\Repositories\ShipmentCartonRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheShipmentCartonDecorator extends BaseCacheDecorator implements ShipmentCartonRepository
{
    public function __construct(ShipmentCartonRepository $shipmentcarton)
    {
        parent::__construct();
        $this->entityName = 'process.shipmentcartons';
        $this->repository = $shipmentcarton;
    }
}
