<?php

namespace App\Repositories\Project;

use App\Models\Project;

interface ProjectRepositoryInterface
{
    public function getProject(int $projectId): Project;
}
