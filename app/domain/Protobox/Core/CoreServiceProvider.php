<?php namespace Protobox\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {

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
        $this->registerRepositories();
    }

    /**
     * Register the repositories.
     *
     * @return void
     */
    protected function registerRepositories()
    {
        $this->app->bind('Protobox\Bin\PasteRepositoryInterface', 'Protobox\Bin\EloquentPasteRepository');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}