<?php

namespace App\Repositories\Project;

use App\Models\Project;


class ProjectRepository implements ProjectRepositoryInterface
{
    public function getProject(int $projectId): Project
    {
        return Project::select([
            'id', 'company_id', 'category_id', 'title',
            'budget_min', 'budget_max', 'deadline', 'status',
        ])
        ->withCount('bids')
        ->withMin(['bids as min_bid'], 'proposed_value')
        ->withMax(['bids as max_bid'], 'proposed_value')
        ->with([
            'company:id,company_name,user_id',
            'company.user:id,email',
            'category:id,name',
            'skills:id,name'
        ])
        ->findOrFail($projectId);
    }
}
