<?php

use Shafiqruslan\BcpTesting\Http\Controllers\BcpTestingController;
use Illuminate\Support\Facades\Route;

if (env('BCP_TESTING', false)) {
    Route::get('/', [BcpTestingController::class, 'index'])->name('bcp-testing.index');
}

// Fallback route for unmatched API routes
Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Route not found',
    ], 404);
});
