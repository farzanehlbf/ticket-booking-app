<?php

namespace App\Providers;

use App\Contracts\Repositories\OriginRepositoryInterface;
use App\Repositories\OriginRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OriginRepositoryInterface::class, OriginRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
