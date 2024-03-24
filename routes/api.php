<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiController;



Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::controller(ApiController::class)->middleware('auth')->group(function() {
    Route::get('/games', 'games');
    Route::post('/games/ratings', 'gameRatingAdd');
});

Route::controller(AuthController::class)->group(function() {
    Route::post('/logout', 'logout');
});
