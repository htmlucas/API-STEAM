<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Steam\SteamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['log.acesso'])->group( function () {
    
    //Route::post('/login', function (Request $request) {return $request->user();})->middleware('auth:sanctum');
    Route::post('/login', [AuthController::class, 'login']);


    Route::middleware(['jwt.auth'])->group(function () {
        
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class,  'refresh']);
        Route::post('/me', [AuthController::class, 'me']);

        Route::get('/ping', fn () => response()->json(['pong' => true]));
        Route::get('/dashboard', function() { return 'Dashboard Acessado!'; });

        
        Route::middleware(['client.key','steam.key'])->prefix('steam')->group(function () {

            Route::post('get-profile', [SteamController::class, 'get_profile']);
            Route::post('add-profile', [SteamController::class, 'add-profile']);
            Route::post('games', [SteamController::class, 'games']);
            
        });

    });

});


