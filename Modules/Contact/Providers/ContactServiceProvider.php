<?php

namespace Modules\Contact\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Contact\Listeners\RegisterContactSidebar;

class ContactServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterContactSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('categories', Arr::dot(trans('contact::categories')));
            $event->load('contacts', Arr::dot(trans('contact::contacts')));
            $event->load('contactdetails', Arr::dot(trans('contact::contactdetails')));
            // append translations



        });
    }

    public function boot()
    {
        $this->publishConfig('contact', 'permissions');

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
            'Modules\Contact\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Contact\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Contact\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Contact\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Contact\Repositories\ContactRepository',
            function () {
                $repository = new \Modules\Contact\Repositories\Eloquent\EloquentContactRepository(new \Modules\Contact\Entities\Contact());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Contact\Repositories\Cache\CacheContactDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Contact\Repositories\ContactDetailRepository',
            function () {
                $repository = new \Modules\Contact\Repositories\Eloquent\EloquentContactDetailRepository(new \Modules\Contact\Entities\ContactDetail());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Contact\Repositories\Cache\CacheContactDetailDecorator($repository);
            }
        );
// add bindings



    }


}
