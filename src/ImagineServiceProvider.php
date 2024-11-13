<?php

namespace Orchestra\Imagine;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Support\DeferrableProvider;
use Imagine\Image\ImagineInterface;
use Orchestra\Support\Providers\ServiceProvider;

class ImagineServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('orchestra.imagine', function (Container $app) {
            return new ImagineManager($app);
        });
    }

    /**
     * Register the core class aliases in the container.
     */
    protected function registerCoreContainerAliases(): void
    {
        $this->callAfterResolving('orchestra.imagine', function ($manager, $app) {
            $namespace = 'orchestra.imagine';

            $manager->setConfiguration($app->make('config')->get($namespace));
        });

        $this->app->alias('orchestra.imagine', ImagineManager::class);

        $this->app->bind(ImagineInterface::class, static function (Container $app) {
            return $app->make('orchestra.imagine')->driver();
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $path = \realpath(__DIR__ . '/../');

        $this->mergeConfigFrom("{$path}/config/config.php", 'orchestra.imagine');

        $this->publishes([
            "{$path}/config/config.php" => config_path('orchestra/imagine.php'),
        ], ['orchestra-imagine', 'laravel-config']);

        $this->registerCoreContainerAliases();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['orchestra.imagine', ImagineInterface::class];
    }
}
