<?php

namespace Shafiqruslan\BcpTesting;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Shafiqruslan\BcpTesting\Http\Middleware\ValidateApiKey;

class BcpTestingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge config so it's accessible via config('bcp-testing.enabled')
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bcp-testing.php',
            'bcp-testing'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register middleware
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('bcp.api.key', ValidateApiKey::class);

        // Merge config so it's accessible via config('bcp-testing.enabled')
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bcp-testing.php',
            'bcp-testing'
        );

        Route::prefix('api/bcp-testing')
            ->middleware('api')
            ->as('bcp-testing.')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
            });
    }
}
