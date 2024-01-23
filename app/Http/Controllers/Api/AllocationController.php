<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\AllocationRequest;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Interface\Repository\AllocationRepositoryInterface;
use App\Interface\Services\CafeteriaValidationServiceInterface;
use App\Models\Allocation;
use Illuminate\Http\JsonResponse;

class AllocationController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var CafeteriaValidationServiceInterface
     */
    private CafeteriaValidationServiceInterface $cafeteriaValidationService;


    /**
     * @var AllocationRepositoryInterface
     */
    private AllocationRepositoryInterface $allocationRepository;


    /**
     * @param CafeteriaValidationServiceInterface $cafeteriaValidationService
     * @param AllocationRepositoryInterface $allocationRepository
     */
    public function __construct(CafeteriaValidationServiceInterface $cafeteriaValidationService, AllocationRepositoryInterface $allocationRepository)
    {
        $this->cafeteriaValidationService = $cafeteriaValidationService;
        $this->allocationRepository = $allocationRepository;
    }


    /**
     * @return JsonResponse|int
     */
    public function index(): JsonResponse|int
    {
        return $this->allocationRepository->getAllocations();
    }


    /**
     * @param Allocation $allocation
     * @return JsonResponse
     */
    public function show(Allocation $allocation): JsonResponse
    {
        return $this->allocationRepository->getAllocation($allocation);
    }


    /**
     * @param AllocationRequest $request
     * @param Allocation $allocation
     * @return JsonResponse
     */
    public function update(AllocationRequest $request, Allocation $allocation): JsonResponse
    {
        // Cafeteria and pockets max limit validations
        $validationErrors = [
            ...$this->cafeteriaValidationService->validateCafeteriaLimit($request, $allocation),
            ...$this->cafeteriaValidationService->validatePocket('pocket1', $request, $allocation),
            ...$this->cafeteriaValidationService->validatePocket('pocket2', $request, $allocation),
            ...$this->cafeteriaValidationService->validatePocket('pocket3', $request, $allocation),
        ];

        if (!empty($validationErrors)) {
            return $this->respondError($validationErrors[array_key_first($validationErrors)], 400, $validationErrors);
        }

        return $this->allocationRepository->updateAllocation($allocation, $request->all());
    }


    /**
     * @param Allocation $allocation
     * @return JsonResponse
     */
    public function reset(Allocation $allocation): JsonResponse
    {
        return $this->allocationRepository->resetAllocation($allocation);
    }

}
