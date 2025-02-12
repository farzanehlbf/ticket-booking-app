<?php

namespace App\Providers;

use App\Contracts\Repositories\DestinationRepositoryInterface;
use App\Contracts\Repositories\OriginRepositoryInterface;
use App\Contracts\Repositories\TerminalRepositoryInterface;
use App\Repositories\DestinationRepository;
use App\Repositories\OriginRepository;
use App\Repositories\TerminalRepository;
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
        $this->app->bind(TerminalRepositoryInterface::class, TerminalRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
