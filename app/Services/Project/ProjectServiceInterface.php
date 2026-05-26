<?php

namespace App\Services\Project;

use App\Enums\FreelancerStatusEnum;
use App\Services\Freelancer\DTO\FreelancerListOutputDTO;
use App\Services\Project\DTO\ProjectOutputDTO;

interface ProjectServiceInterface
{
    public function getProject(int $projectId): ProjectOutputDTO;
}
