<?php

use Shafiqruslan\BcpTesting\Http\Controllers\BcpTestingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BcpTestingController::class, 'index'])->name('bcp-testing.index');
