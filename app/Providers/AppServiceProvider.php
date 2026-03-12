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
        // 1. Настройка путей для кэша во временной папке Vercel
        if (config('view.compiled') === '/tmp') {
            if (!is_dir('/tmp/views')) {
                mkdir('/tmp/views', 0755, true);
            }
            config(['view.compiled' => '/tmp/views']);
        }

        // 2. Принудительный HTTPS для корректной загрузки CSS/JS на Vercel
        if (env('APP_ENV') === 'production' || env('VERCEL_ENV')) {
            URL::forceScheme('https');
        }
    }
}