<?php

namespace Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
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
        $this->registerUnitRepository();
        $this->registerCategoryRepository();
        $this->registerProductRepository();
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
            __DIR__.'/../Config/config.php' => config_path('product.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'product'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/product');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/product';
        }, \Config::get('view.paths')), [$sourcePath]), 'product');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/product');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'product');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'product');
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

	public function registerUnitRepository() {
		return $this->app->bind(
			'Modules\\Product\\Repositories\\UnitRepository',
			'Modules\\Product\\Repositories\\UnitEloquent'

		);
	}

	public function registerCategoryRepository() {
		return $this->app->bind(
			'Modules\\Product\\Repositories\\CategoryRepository',
			'Modules\\Product\\Repositories\\CategoryEloquent'

		);
	}

	public function registerProductRepository() {
		return $this->app->bind(
			'Modules\\Product\\Repositories\\ProductRepository',
			'Modules\\Product\\Repositories\\ProductEloquent'

		);
	}
}