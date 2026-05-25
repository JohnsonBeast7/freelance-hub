<?php

namespace App\Http\Controllers;

use App\Services\Freelancer\FreelancerServiceInterface;
use Illuminate\Http\JsonResponse;

class FreelancerController extends Controller
{
    public function __construct(
        private FreelancerServiceInterface $service
    ) {}
    
    public function listAvailable(): JsonResponse
    {
        return new JsonResponse(['data' => $this->service->listAvailable()->toResponse()]);
    }
}
