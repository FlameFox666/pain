<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Настройка путей для кэша (у вас уже есть)
        if (config('view.compiled') === '/tmp') {
            if (!is_dir('/tmp/views')) {
                mkdir('/tmp/views', 0755, true);
            }
            config(['view.compiled' => '/tmp/views']);
        }

        // 2. СОЗДАНИЕ SQLITE БАЗЫ В /TMP
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if (!file_exists($dbPath) && str_starts_with($dbPath, '/tmp')) {
                touch($dbPath);
            }
        }

        // 3. HTTPS (обязательно для CSS)
        if (env('APP_ENV') === 'production' || env('VERCEL_ENV')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}