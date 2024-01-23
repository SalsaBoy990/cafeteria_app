<?php

namespace App\Providers;

use App\Interface\Repository\AllocationRepositoryInterface;
use App\Interface\Services\CafeteriaValidationServiceInterface;
use App\Interface\Services\DataExportServiceInterface;
use App\Repository\AllocationRepository;
use App\Services\CafeteriaValidationService;
use App\Services\DataExportService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CafeteriaValidationServiceInterface::class, CafeteriaValidationService::class);
        $this->app->bind(AllocationRepositoryInterface::class, AllocationRepository::class);
        $this->app->bind(DataExportServiceInterface::class, DataExportService::class);
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
