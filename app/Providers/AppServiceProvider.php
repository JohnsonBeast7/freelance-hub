<?php

namespace App\Providers;

use App\Repositories\Freelancer\FreelancerRepository;
use App\Repositories\Freelancer\FreelancerRepositoryInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Services\Freelancer\FreelancerService;
use App\Services\Freelancer\FreelancerServiceInterface;
use App\Services\Project\ProjectService;
use App\Services\Project\ProjectServiceInterface;
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

        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
