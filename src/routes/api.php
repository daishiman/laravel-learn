<?php

declare(strict_types=1);

use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\Student\CreateController;
use App\Http\Controllers\Api\Student\IndexController;
use App\Http\Controllers\Api\Student\ShowController;
use App\Http\Controllers\Api\Student\UpdateController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', MeController::class);
    Route::post('/student', CreateController::class);
    Route::get('/student', IndexController::class);
    Route::get('/student/{student}', ShowController::class);
    Route::put('/student/{student}', UpdateController::class);
});
