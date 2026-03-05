<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        if (config('view.compiled') === '/tmp') {
            if (!is_dir('/tmp/views')) {
                mkdir('/tmp/views', 0755, true);
            }
            config(['view.compiled' => '/tmp/views']);
        }
    }
}
