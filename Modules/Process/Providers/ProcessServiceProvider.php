<?php

namespace Modules\Process\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Process\Events\Handlers\RegisterProcessSidebar;
use Modules\Process\Repositories\ProductRepository;

class ProcessServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterProcessSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('process', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            ProductRepository::class,
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentProductRepository(new \Modules\Process\Entities\Product());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheProductDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\CartonRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentCartonRepository(new \Modules\Process\Entities\Carton());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheCartonDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\ProductCodeRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentProductCodeRepository(new \Modules\Process\Entities\ProductCode());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheProductCodeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\CartonLocationRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentCartonLocationRepository(new \Modules\Process\Entities\CartonLocation());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheCartonLocationDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\QualityParameterRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentQualityParameterRepository(new \Modules\Process\Entities\QualityParameter());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheQualityParameterDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\TransferRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentTransferRepository(new \Modules\Process\Entities\Transfer());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheTransferDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\TransferCartonRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentTransferCartonRepository(new \Modules\Process\Entities\TransferCarton());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheTransferCartonDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\ThrowingRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentThrowingRepository(new \Modules\Process\Entities\Throwing());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheThrowingDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\ShipmentRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentShipmentRepository(new \Modules\Process\Entities\Shipment());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheShipmentDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\ShipmentCartonRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentShipmentCartonRepository(new \Modules\Process\Entities\ShipmentCarton());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheShipmentCartonDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\RepackRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentRepackRepository(new \Modules\Process\Entities\Repack());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheRepackDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\RepackingRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentRepackingRepository(new \Modules\Process\Entities\Repacking());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheRepackingDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\PackingRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentPackingRepository(new \Modules\Process\Entities\Packing());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CachePackingDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Process\Repositories\ShipmentFileRepository',
            function () {
                $repository = new \Modules\Process\Repositories\Eloquent\EloquentShipmentFileRepository(new \Modules\Process\Entities\ShipmentFile());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Process\Repositories\Cache\CacheShipmentFileDecorator($repository);
            }
        );
// add bindings















    }
}
