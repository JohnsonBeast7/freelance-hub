<?php

namespace App\Repositories\Freelancer;

use App\Enums\FreelancerStatusEnum;
use Illuminate\Support\Collection;

interface FreelancerRepositoryInterface
{
    public function list(?FreelancerStatusEnum $status = null): Collection;
}
