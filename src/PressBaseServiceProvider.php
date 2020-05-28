<?php

namespace Bryceandy\Press;

use Bryceandy\Press\Facades\Press;
use Bryceandy\Press\Console\ProcessCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole())
            $this->registerPublishing();

        $this->registerResources();
    }

    public function register()
    {
        $this->commands([
            ProcessCommand::class,
        ]);
    }

    private function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/press.php' => config_path('press.php'),
        ], 'press-config');

        $this->publishes([
            __DIR__.'/Console/stubs/PressServiceProvider.stub' => app_path('Providers/PressServiceProvider.php'),
        ], 'press-provider');
    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'press');

        $this->registerFacades();
        $this->registerRoutes();
        $this->registerFields();
    }

    private function registerFacades()
    {
        $this->app->singleton('Press', fn($app) => new \Bryceandy\Press\Press());
    }
    
    private function registerRoutes()
    {
        Route::group([
            'prefix' => Press::path(),
            'namespace' => 'Bryceandy\Press\Http\Controllers',
        ], fn() => $this->loadRoutesFrom(__DIR__ . '/../routes/web.php'));
    }

    private function registerFields()
    {
        Press::fields([
            Fields\Title::class,
            Fields\Body::class,
            Fields\Date::class,
            //Fields\Description::class,
            Fields\Extra::class,
        ]);
    }
}
