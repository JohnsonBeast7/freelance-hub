<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetProjectRequest;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function __construct(
        private ProjectServiceInterface $service
    ) {}

    public function getProject(int $projectId): JsonResponse
    {
        return new JsonResponse([
            'project' => $this->service->getProject($projectId)->toResponse()
        ]);
    }
}
