<?php

namespace App\Repositories\Freelancer;

use App\Enums\FreelancerStatusEnum;
use App\Models\Freelancer;
use Illuminate\Support\Collection;

class FreelancerRepository implements FreelancerRepositoryInterface
{
    public function listAvailable(): Collection
    {
        return Freelancer::select([
            'id', 'city', 'state', 'hourly_rate', 'availability_status',
            'rating_average', 'total_reviews', 'user_id',
        ])
        ->with([
            'user:id,name',
            'skills:id,name',
        ])
        ->where('availability_status', FreelancerStatusEnum::AVAILABLE)
        ->get();
    }
}
