<?php

namespace App\Services\Freelancer;

use App\Repositories\Freelancer\FreelancerRepositoryInterface;
use App\Services\Freelancer\DTO\ListAvailableOutputDTO;

class FreelancerService implements FreelancerServiceInterface
{
    public function __construct(
        private FreelancerRepositoryInterface $repository
    ) {}

    public function listAvailable(): ListAvailableOutputDTO
    {
        return new ListAvailableOutputDTO($this->repository->listAvailable());
    }
}
