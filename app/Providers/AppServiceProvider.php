<?php

namespace App\Providers;

use App\Macros\CollectionMacros;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        CollectionMacros::register();
        Passport::enablePasswordGrant();

    }
}
