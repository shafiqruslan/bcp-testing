<?php

use Shafiqruslan\BcpTesting\Http\Controllers\BcpTestingController;
use Illuminate\Support\Facades\Route;

if (env('BCP_TESTING', false)) {
    Route::get('/', [BcpTestingController::class, 'index'])->name('bcp-testing.index');
}
