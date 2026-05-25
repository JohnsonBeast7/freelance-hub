<?php

namespace App\Repositories\Freelancer;

use Illuminate\Support\Collection;

interface FreelancerRepositoryInterface
{
    public function listAvailable(): Collection;
}
