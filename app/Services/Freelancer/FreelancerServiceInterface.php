<?php

namespace App\Services\Freelancer;

use App\Enums\FreelancerStatusEnum;
use App\Services\Freelancer\DTO\FreelancerListOutputDTO;

interface FreelancerServiceInterface
{
    public function list(?FreelancerStatusEnum $status = null): FreelancerListOutputDTO;
}
