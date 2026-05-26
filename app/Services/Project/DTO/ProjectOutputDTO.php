<?php

namespace App\Services\Project\DTO;

use App\Models\Project;
use App\Responsers\Project\GetProjectResponser;

readonly class ProjectOutputDTO
{
    public function __construct(
        public Project $project,
    ) {}

    public function toResponse(): array
    {
        return new GetProjectResponser($this->project)->response();
    }
}
