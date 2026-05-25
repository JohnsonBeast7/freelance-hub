<?php

namespace App\Services\Freelancer\DTO;

use App\Responsers\Freelancer\ListAvailableResponser;
use Illuminate\Support\Collection;

readonly class ListAvailableOutputDTO
{
    public function __construct(
        public Collection $availableFreelancers,
    ) {}

    public function toResponse(): array
    {
        return new ListAvailableResponser($this->availableFreelancers)->response();
    }
}
