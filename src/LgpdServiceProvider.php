<?php
namespace Thiagoprz\Lgpd;

use Illuminate\Support\ServiceProvider;
use Thiagoprz\Lgpd\Http\Controllers\LgpdTermController;
use Thiagoprz\Lgpd\Http\Controllers\LgpdTermItemController;
use Thiagoprz\Lgpd\Http\Controllers\LgpdUserAcceptanceController;

class LgpdServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->make(LgpdTermController::class);
        $this->app->make(LgpdTermItemController::class);
        $this->app->make(LgpdUserAcceptanceController::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lgpd');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/lgpd'),
        ]);

        // Routes for testing tool
        include __DIR__.'/routes/web.php';
    }

}
