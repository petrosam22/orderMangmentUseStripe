<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            \App\Repositories\Api\Contracts\AdminsRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\AdminsRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\ProductsRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\ProductsRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\OrdersRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\OrdersRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
