<?php

namespace Modules\App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerAppRepository();
        $this->registerPermissionRepository();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('app.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'app'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/app');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/app';
        }, \Config::get('view.paths')), [$sourcePath]), 'app');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/app');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'app');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'app');
        }
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
    public function registerAppRepository(){
        return $this->app->bind(
            'Modules\\App\\Repositories\\AppRepository',
            'Modules\\App\\Repositories\\EloquentApp'
            );
    }
    public function registerPermissionRepository(){
        return $this->app->bind(
            'Modules\\Permission\\Repositories\\PermissionRepository',
            'Modules\\Permission\\Repositories\\EloquentPermission'
            );
    }
}
