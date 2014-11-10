<?php

namespace Tricks\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Tricks\Repositories\UserRepositoryInterface',
            'Tricks\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\ProfileRepositoryInterface',
            'Tricks\Repositories\Eloquent\ProfileRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\TrickRepositoryInterface',
            'Tricks\Repositories\Eloquent\TrickRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\CountryRepositoryInterface',
            'Tricks\Repositories\Eloquent\CountryRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\TagRepositoryInterface',
            'Tricks\Repositories\Eloquent\TagRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\CiudadRepositoryInterface',
            'Tricks\Repositories\Eloquent\CiudadRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\CategoryRepositoryInterface',
            'Tricks\Repositories\Eloquent\CategoryRepository'
        );
        $this->app->bind(
            'Tricks\Repositories\PaisRepositoryInterface',
            'Tricks\Repositories\Eloquent\PaisRepository'
        );
        $this->app->bind(
            'Tricks\Repositories\PersonalRepositoryInterface',
            'Tricks\Repositories\Eloquent\PersonalRepository'
        );
    }
}
