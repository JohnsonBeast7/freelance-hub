<?php

namespace App\Services\Freelancer\DTO;

use App\Responsers\Freelancer\ListAvailableResponser;
use Illuminate\Support\Collection;

readonly class FreelancerListOutputDTO
{
    public function __construct(
        public Collection $freelancers,
    ) {}

    public function toResponse(): array
    {
        return new ListAvailableResponser($this->freelancers)->response();
    }
}
