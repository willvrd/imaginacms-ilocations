<?php

namespace Modules\Ilocations\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Ilocations\Listeners\RegisterIlocationsSidebar;

class IlocationsServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterIlocationsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            // append translations
        });


    }

    public function boot()
    {
        $this->publishConfig('ilocations', 'config');
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'permissions'), "asgard.ilocations.permissions");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'settings'), "asgard.ilocations.settings");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'settings-fields'), "asgard.ilocations.settings-fields");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'cmsPages'), "asgard.ilocations.cmsPages");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'cmsSidebar'), "asgard.ilocations.cmsSidebar");
        //$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
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
            'Modules\Ilocations\Repositories\CityRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentCityRepository(new \Modules\Ilocations\Entities\City());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CacheCityDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ilocations\Repositories\CountryRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentCountryRepository(new \Modules\Ilocations\Entities\Country());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CacheCountryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ilocations\Repositories\GeozonesRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentGeozonesRepository(new \Modules\Ilocations\Entities\Geozones());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CacheGeozonesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ilocations\Repositories\LocalityRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentLocalityRepository(new \Modules\Ilocations\Entities\Locality());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CacheLocalityDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ilocations\Repositories\NeighborhoodRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentNeighborhoodRepository(new \Modules\Ilocations\Entities\Neighborhood());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CacheNeighborhoodDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ilocations\Repositories\PolygonRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentPolygonRepository(new \Modules\Ilocations\Entities\Polygon());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CachePolygonDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ilocations\Repositories\ProvinceRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentProvinceRepository(new \Modules\Ilocations\Entities\Province());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CacheProvinceDecorator($repository);
            }
        );
// add bindings







    }


}
