<?php

namespace Shafiqruslan\BcpTesting;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        Route::prefix('bcp-testing')
            ->as('bcp-testing.')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
            });
    }
}
