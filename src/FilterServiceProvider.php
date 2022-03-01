<?php

namespace Mahi\SpatieTagsNovaFilter;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('spatie-tags-nova-filter', __DIR__ . '/../dist/js/filter.js');
            Nova::style('spatie-tags-nova-filter', __DIR__ . '/../dist/css/filter.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->prefix('nova-vendor/spatie-tags-nova-filter')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
