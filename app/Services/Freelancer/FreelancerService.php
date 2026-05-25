<?php

namespace App\Services\Freelancer;

use App\Enums\FreelancerStatusEnum;
use App\Repositories\Freelancer\FreelancerRepositoryInterface;
use App\Services\Freelancer\DTO\FreelancerListOutputDTO;

class FreelancerService implements FreelancerServiceInterface
{
    public function __construct(
        private FreelancerRepositoryInterface $repository
    ) {}

    public function list(?FreelancerStatusEnum $status = null): FreelancerListOutputDTO
    {
        return new FreelancerListOutputDTO($this->repository->list($status));
    }
}
