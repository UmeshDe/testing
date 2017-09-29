<?php

namespace Modules\Reports\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Reports\Events\Handlers\RegisterReportsSidebar;

class ReportsServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterReportsSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('reports', 'permissions');

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
            'Modules\Reports\Repositories\ReportMasterRepository',
            function () {
                $repository = new \Modules\Reports\Repositories\Eloquent\EloquentReportMasterRepository(new \Modules\Reports\Entities\ReportMaster());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Reports\Repositories\Cache\CacheReportMasterDecorator($repository);
            }
        );
// add bindings

    }
}
