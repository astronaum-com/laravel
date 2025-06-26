<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;


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
       // Remove X-Frame-Options header
    header_remove('X-Frame-Options');

    // Set CSP to allow iframing from anywhere (or your specific frontend domain)
    header("Content-Security-Policy: frame-ancestors *"); // or use your domain

    // Optional: if you're seeing it added by Laravel, you can also intercept the response
    Response::macro('withoutFrameHeaders', function ($response) {
        return $response->header('X-Frame-Options', '')->header('Content-Security-Policy', 'frame-ancestors *');
    });
    }
}
