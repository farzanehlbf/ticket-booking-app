<?php

namespace App\Providers;

use App\Contracts\Repositories\DestinationRepositoryInterface;
use App\Contracts\Repositories\OriginRepositoryInterface;
use App\Repositories\DestinationRepository;
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
        $this->app->bind(DestinationRepositoryInterface::class, DestinationRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
