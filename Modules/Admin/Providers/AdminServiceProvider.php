<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Admin\Events\Handlers\RegisterAdminSidebar;

class AdminServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterAdminSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('admin', 'permissions');

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
            'Modules\Admin\Repositories\ApprovalNumberRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentApprovalNumberRepository(new \Modules\Admin\Entities\ApprovalNumber());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheApprovalNumberDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\BagcolorRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentBagcolorRepository(new \Modules\Admin\Entities\Bagcolor());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheBagcolorDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\CartonTypeRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentCartonTypeRepository(new \Modules\Admin\Entities\CartonType());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheCartonTypeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\CodeMasterRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentCodeMasterRepository(new \Modules\Admin\Entities\CodeMaster());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheCodeMasterDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\DepartmentRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentDepartmentRepository(new \Modules\Admin\Entities\Department());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheDepartmentDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\EmployeeRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentEmployeeRepository(new \Modules\Admin\Entities\Employee());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheEmployeeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\FishTypeRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentFishTypeRepository(new \Modules\Admin\Entities\FishType());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheFishTypeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\GradeRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentGradeRepository(new \Modules\Admin\Entities\Grade());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheGradeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\KindRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentKindRepository(new \Modules\Admin\Entities\Kind());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheKindDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\LocationRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentLocationRepository(new \Modules\Admin\Entities\Location());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheLocationDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\DesignationRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentDesignationRepository(new \Modules\Admin\Entities\Designation());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheDesignationDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\BuyercodeRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentBuyercodeRepository(new \Modules\Admin\Entities\Buyercode());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheBuyercodeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\InternalcodeRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentInternalcodeRepository(new \Modules\Admin\Entities\Internalcode());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheInternalcodeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Admin\Repositories\CheckmarkRepository',
            function () {
                $repository = new \Modules\Admin\Repositories\Eloquent\EloquentCheckmarkRepository(new \Modules\Admin\Entities\Checkmark());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Admin\Repositories\Cache\CacheCheckmarkDecorator($repository);
            }
        );
// add bindings














    }
}
