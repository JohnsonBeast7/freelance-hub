<?php

namespace App\Http\Controllers;

use App\Enums\FreelancerStatusEnum;
use App\Services\Freelancer\FreelancerServiceInterface;
use Illuminate\Http\JsonResponse;

class FreelancerController extends Controller
{
    public function __construct(
        private FreelancerServiceInterface $service
    ) {}

    public function listAll(): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->service->list()->toResponse()
        ]);
    }

    public function listAvailable(): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->service->list(FreelancerStatusEnum::AVAILABLE)->toResponse()
        ]);
    }

    public function listBusy(): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->service->list(FreelancerStatusEnum::BUSY)->toResponse()
        ]);
    }

    public function listUnavailable(): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->service->list(FreelancerStatusEnum::UNAVAILABLE)->toResponse()
        ]);
    }
}
