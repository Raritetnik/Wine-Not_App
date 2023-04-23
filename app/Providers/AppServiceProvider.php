<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::include('partials.svgs');
        \Illuminate\Support\Facades\Response::macro('svg', function ($path, $status = 200, array $headers = []) {
            $contents = file_get_contents($path);
            $response = new \Illuminate\Http\Response($contents, $status, $headers);
            $response->header('Content-Type', 'image/svg+xml');
            return $response;
        });
        // add the following line
        \Illuminate\Http\Response::macro('allowedSvg', function ($content) {
            $content->header('Content-Type', 'image/svg+xml');
            return $content;
        });
    }
}
