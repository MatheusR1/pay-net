<?php

namespace App\Providers;

use App\Service\ViaCepService;
use Illuminate\Support\ServiceProvider;

class ViaCepProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ViaCepService::class, fn () => new ViaCepService());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
