<?php

namespace App\Repositories\Freelancer;

use App\Enums\FreelancerStatusEnum;
use App\Models\Freelancer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


class FreelancerRepository implements FreelancerRepositoryInterface
{
    public function list(?FreelancerStatusEnum $status = null): Collection
    {
        $query = Freelancer::select([
            'id', 'city', 'state', 'hourly_rate', 'availability_status',
            'rating_average', 'total_reviews', 'user_id',
        ])
        ->with([
            'user:id,name',
            'skills:id,name',
        ]);

        return $this->filterByStatus($query, $status)->get();
    }

    private function filterByStatus(Builder $query, ?FreelancerStatusEnum $status): Builder
    {
        return $status
            ? $query->where('availability_status', $status)
            : $query->orderBy('availability_status');
    }
}
