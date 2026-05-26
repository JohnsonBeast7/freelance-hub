<?php

namespace App\Services\Project;

use App\Repositories\Project\ProjectRepositoryInterface;
use App\Services\Project\DTO\ProjectOutputDTO;

class ProjectService implements ProjectServiceInterface
{
    public function __construct(
        private ProjectRepositoryInterface $repository
    ) {}

    public function getProject(int $projectId): ProjectOutputDTO
    {
        return new ProjectOutputDTO($this->repository->getProject($projectId));
    }
}
