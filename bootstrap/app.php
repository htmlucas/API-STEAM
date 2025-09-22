<?php

use App\Http\Middleware\CheckClientKey;
use App\Http\Middleware\CheckSteamKey;
use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'log.acesso' => LogAcessoMiddleware::class,
            'steam.key' => CheckSteamKey::class,
            'client.key' => CheckClientKey::class,
            'jwt.auth' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
        ]);

        // Se quiser aplicar em TODO o grupo API:
        // $middleware->api(prepend: [ CheckClientKey::class ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
