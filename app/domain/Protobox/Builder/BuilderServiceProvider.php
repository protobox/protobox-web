<?php namespace Protobox\Builder;

use Illuminate\Support\ServiceProvider;

class BuilderServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBoxBuilder();
    }

    /**
     * Register the builder instance.
     *
     * @return void
     */
    protected function registerBoxBuilder()
    {
        $this->app['boxbuilder'] = $this->app->share(function($app)
        {
            $builder = new BoxBuilder($app['request'], $app['validator']);

            return $builder->build();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['boxbuilder'];
    }

}