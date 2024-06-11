<?php

namespace Modules\Ilocations\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Ilocations\Events\Handlers\RegisterIlocationsSidebar;

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
     */
    public function register(): void
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIlocationsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('countries', Arr::dot(trans('ilocations::countries')));
            $event->load('provinces', Arr::dot(trans('ilocations::provinces')));
            $event->load('cities', Arr::dot(trans('ilocations::cities')));
            $event->load('polygons', Arr::dot(trans('ilocations::polygons')));
            // append translations
        });
    }

    public function boot(): void
    {
        $this->publishConfig('ilocations', 'config');
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'permissions'), 'asgard.ilocations.permissions');
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'settings'), 'asgard.ilocations.settings');
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'settings-fields'), 'asgard.ilocations.settings-fields');
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'cmsPages'), 'asgard.ilocations.cmsPages');
        $this->mergeConfigFrom($this->getModuleConfigFilePath('ilocations', 'cmsSidebar'), 'asgard.ilocations.cmsSidebar');
        //$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function registerBindings()
    {
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
            'Modules\Ilocations\Repositories\ProvinceRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentProvinceRepository(new \Modules\Ilocations\Entities\Province());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CacheProvinceDecorator($repository);
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
            'Modules\Ilocations\Repositories\LocalityRepository',
            function () {
                $repository = new \Modules\Ilocations\Repositories\Eloquent\EloquentLocalityRepository(new \Modules\Ilocations\Entities\Locality());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ilocations\Repositories\Cache\CacheLocalityDecorator($repository);
            }
        );
        // add bindings
    }
}
