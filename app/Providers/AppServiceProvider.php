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
        $this->app->singleton('admin', function () {
            return auth('admin-api')->user();
        });

        $this->app->singleton('ketua', function () {
            return auth('ketua-api')->user();
        });

        $this->app->singleton('anggota', function () {
            return auth('anggota-api')->user();
        });

        $this->app->singleton('user', function () {
            return auth('admin-api')->user() ?? auth('ketua-api')->user() ?? auth('anggota-api')->user();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
