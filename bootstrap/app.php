<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // --- Đăng ký Route Middleware Aliases tại đây ---
        $middleware->alias([
            'admin' => App\Http\Middleware\EnsureUserIsAdmin::class,
            'employee' => App\Http\Middleware\EnsureUserIsEmployee::class,
            // Thêm các alias khác nếu cần
            // Ví dụ: 'auth' và 'guest' thường được Laravel tự đăng ký
            // thông qua các service provider hoặc các gói như Breeze/Jetstream
            // 'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);

        // --- Bạn cũng có thể đăng ký Global Middleware tại đây ---
        // $middleware->use([
        //     // \Illuminate\Http\Middleware\TrustHosts::class,
        //     \Illuminate\Http\Middleware\TrustProxies::class,
        //     \Illuminate\Http\Middleware\HandleCors::class,
        //     \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
        //     \Illuminate\Http\Middleware\ValidatePostSize::class,
        //     \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        //     \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        // ]);
    
        // --- Hoặc tinh chỉnh các nhóm middleware (ít phổ biến hơn) ---
        // $middleware->web(append: [
        //     // Thêm middleware vào cuối nhóm 'web'
        // ]);
        // $middleware->api(prepend: [
        //      // Thêm middleware vào đầu nhóm 'api'
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
