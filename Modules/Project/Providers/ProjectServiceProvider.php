<?php

namespace Modules\Project\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Project\Listeners\RegisterProjectSidebar;

class ProjectServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterProjectSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('categories', Arr::dot(trans('project::categories')));
            $event->load('projects', Arr::dot(trans('project::projects')));
            // append translations


        });
    }

    public function boot()
    {
        $this->publishConfig('project', 'permissions');

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
            'Modules\Project\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Project\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Project\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Project\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Project\Repositories\ProjectRepository',
            function () {
                $repository = new \Modules\Project\Repositories\Eloquent\EloquentProjectRepository(new \Modules\Project\Entities\Project());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Project\Repositories\Cache\CacheProjectDecorator($repository);
            }
        );
// add bindings


    }


}
