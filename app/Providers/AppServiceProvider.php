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
        // Ensure storage framework directories exist and are writable
        $paths = [
            storage_path('framework'),
            storage_path('framework/views'),
            storage_path('framework/cache'),
            storage_path('framework/sessions'),
            base_path('bootstrap/cache'),
        ];

        foreach ($paths as $path) {
            if (!file_exists($path)) {
                @mkdir($path, 0777, true);
            } elseif (!is_writable($path)) {
                @chmod($path, 0777);
            }
        }
    }
}
