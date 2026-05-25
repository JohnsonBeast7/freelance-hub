<?php

namespace App\Providers;

use App\Repositories\Freelancer\FreelancerRepository;
use App\Repositories\Freelancer\FreelancerRepositoryInterface;
use App\Services\Freelancer\FreelancerService;
use App\Services\Freelancer\FreelancerServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FreelancerServiceInterface::class, FreelancerService::class);
        $this->app->bind(FreelancerRepositoryInterface::class, FreelancerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
