<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::controller(AdminController::class)->group(function () {
    Route::get('/login', 'loginScreen')->name('login');
    Route::post('/login', 'login');
});

// admin protected route
Route::controller(AdminController::class)->middleware('auth:moderator')->group(function () {
    // admin dashboard route
    Route::get('/', 'dashboardScreen');

    // games crud routes
    Route::get('/games', 'gameListScreen');
    Route::get('/games/add', 'gameAddScreen');
    Route::post('/games/add', 'gameAdd');
    Route::get('/games/edit/{id}', 'gameEdit');
    Route::get('/games/delete/{id}', 'gameDelete');
    
    // review view route
    Route::get('/reviews', 'reviewListScreen');
    
    // sign-out route
    Route::get('/logout', 'logout');
});