<?php

namespace App\Services\Freelancer;

use App\Services\Freelancer\DTO\ListAvailableOutputDTO;

interface FreelancerServiceInterface
{
    public function listAvailable(): ListAvailableOutputDTO;
}
