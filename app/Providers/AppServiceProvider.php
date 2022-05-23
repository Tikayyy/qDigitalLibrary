<?php

namespace App\Providers;

use App\Contracts\BookInterface;
use App\Services\GoogleBookApiService;
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
        $this->app->singleton(BookInterface::class, function ($app) {
            return new GoogleBookApiService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
