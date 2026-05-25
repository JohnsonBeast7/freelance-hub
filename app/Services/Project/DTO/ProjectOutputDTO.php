<?php

namespace App\Services\Project\DTO;

use App\Responsers\Freelancer\ListAvailableResponser;
use Illuminate\Support\Collection;

readonly class ProjectOutputDTO
{
    public function __construct(
        public Collection $freelancers,
    ) {}

    public function toResponse(): array
    {
        return new ListAvailableResponser($this->freelancers)->response();
    }
}
