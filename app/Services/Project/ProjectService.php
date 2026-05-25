<?php

namespace App\Services\Project;

use App\Enums\FreelancerStatusEnum;
use App\Repositories\Freelancer\FreelancerRepositoryInterface;
use App\Services\Freelancer\DTO\FreelancerListOutputDTO;

class ProjectService implements ProjectServiceInterface
{
    public function __construct(
        private FreelancerRepositoryInterface $repository
    ) {}

    public function list(?FreelancerStatusEnum $status = null): FreelancerListOutputDTO
    {
        return new FreelancerListOutputDTO($this->repository->list($status));
    }
}
