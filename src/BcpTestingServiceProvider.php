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
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register middleware
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('bcp.api.key', ValidateApiKey::class);

        Route::prefix('api/bcp-testing')
            ->middleware('api', 'bcp.api.key')
            ->as('bcp-testing.')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
            });
    }
}
