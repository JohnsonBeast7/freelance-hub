<?php

namespace App\Services\Project;

use App\Enums\FreelancerStatusEnum;
use App\Services\Freelancer\DTO\FreelancerListOutputDTO;

interface ProjectServiceInterface
{
    public function list(?FreelancerStatusEnum $status = null): FreelancerListOutputDTO;
}
