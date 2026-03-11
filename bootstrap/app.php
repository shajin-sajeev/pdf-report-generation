<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->booting(function () {
        if (env('VERCEL_JOB_ID')) {
            // Ensure necessary storage directories exist in /tmp
            $paths = [
                '/tmp/storage/framework/views',
                '/tmp/storage/framework/cache/data',
                '/tmp/storage/framework/sessions',
                '/tmp/bootstrap/cache',
            ];

            foreach ($paths as $path) {
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
            }

            // Set Laravel's internal paths to use /tmp
            config(['view.compiled' => '/tmp/storage/framework/views']);
            config(['cache.stores.file.path' => '/tmp/storage/framework/cache/data']);
            config(['session.files' => '/tmp/storage/framework/sessions']);
            
            // Fallback to file drivers if database isn't configured on Vercel
            if (!env('DB_DATABASE') && !env('DATABASE_URL')) {
                config(['session.driver' => 'file']);
                config(['cache.default' => 'file']);
            }

            // dompdf temp directory
            config(['dompdf.options.tempDir' => '/tmp']);
            config(['dompdf.options.isHtml5ParserEnabled' => true]);
        }
    })
    ->create();
