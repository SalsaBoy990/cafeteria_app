<?php

namespace App\Repository;

use App\Http\Resources\AllocationResource;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Interface\Repository\AllocationRepositoryInterface;
use App\Models\Allocation;
use Illuminate\Http\JsonResponse;

class AllocationRepository implements AllocationRepositoryInterface
{
    use ApiResponseTrait;

    /**
     * Gets all allocations
     *
     * @return JsonResponse
     */
    public function getAllocations(): JsonResponse
    {
        return $this->respondWithResourceCollection(AllocationResource::collection(Allocation::all()));
    }


    /**
     * Gets one allocation
     *
     * @param Allocation $allocation
     * @return JsonResponse
     */
    public function getAllocation(Allocation $allocation): JsonResponse
    {
        return $this->respondWithResource(new AllocationResource($allocation));
    }


    /**
     * Updates one allocation
     *
     * @param Allocation $allocation
     * @param array $data
     * @return JsonResponse
     */
    public function updateAllocation(Allocation $allocation, array $data): JsonResponse
    {
        $allocation->update($data);
        return response()->json($allocation);
    }


    /**
     * Resets pockets for one allocation
     *
     * @param Allocation $allocation
     * @return JsonResponse
     */
    public function resetAllocation(Allocation $allocation): JsonResponse
    {
        $allocation->update([
            'pocket1' => 0,
            'pocket2' => 0,
            'pocket3' => 0,
        ]);
        return response()->json($allocation);
    }

}
