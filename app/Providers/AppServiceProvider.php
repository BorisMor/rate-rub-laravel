<?php

declare(strict_types=1);

namespace App\Providers;

use App\Service\Rates\External\Repository\ExternalRepositoryInterface;
use App\Service\Rates\External\Repository\InfoCbrRepository;
use App\Service\Rates\RateService;
use App\Service\Rates\RateServiceInterface;
use App\Service\Rates\Common\Repository\RateDbRepository;
use App\Service\Rates\Common\Repository\RateStoreRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RateServiceInterface::class, RateService::class);
        $this->app->bind(RateStoreRepositoryInterface::class, RateDbRepository::class);
        $this->app->bind(ExternalRepositoryInterface::class, InfoCbrRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
