<?php
/**
 * ServiceProvider - Implements a Service Provider.
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */

namespace Nova\Support;


abstract class ServiceProvider
{
    /**
     * The Application instance.
     *
     * @var \Nova\Foundation\Application
     */
    protected $app;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Create a new service provider instance.
     *
     * @param  \Nova\Foundation\Application     $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {}

    /**
     * Register the service provider.
     *
     * @return void
     */
    abstract public function register();

    /**
     * Register the package's custom Forge commands.
     *
     * @param  array  $commands
     * @return void
     */
    public function commands($commands)
    {
        $commands = is_array($commands) ? $commands : func_get_args();

        // To register the commands with Forge, we will grab each of the arguments
        // passed into the method and listen for Forge "start" event which will
        // give us the Forge console instance which we will give commands to.
        $events = $this->app['events'];

        $events->listen('forge.start', function($forge) use ($commands)
        {
            $forge->resolveCommands($commands);
        });
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

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return array();
    }
    
    /**
     * Determine if the provider is deferred.
     *
     * @return bool
     */
    public function isDeferred()
    {
        return $this->defer;
    }
}
