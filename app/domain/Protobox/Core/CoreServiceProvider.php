<?php namespace Protobox\Core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;

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

        $this->registerSessionBinder();
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

    protected function registerSessionBinder()
    {
        list($app, $me) = array($this->app, $this);

        $app->booted(function() use ($app, $me)
        {
            if ($me->sessionHasMessages($app))
            {
                $messages = $app['session.store']->get('messages');

                $app['view']->share('messages', $messages);
            }
            else
            {
                $app['view']->share('messages', new MessageBag);
            }
        });
    }

    public function sessionHasMessages($app)
    {
        $config = $app['config']['session'];

        if (isset($app['session.store']) and ! is_null($config['driver']))
        {
            return $app['session.store']->has('messages');
        }
    }

}