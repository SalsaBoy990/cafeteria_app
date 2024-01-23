<?php

namespace App\Interface\Repository;

use App\Models\Allocation;
use Illuminate\Http\JsonResponse;

interface AllocationRepositoryInterface
{
    public function getAllocations(): JsonResponse;

    public function getAllocation(Allocation $allocation): JsonResponse;

    public function updateAllocation(Allocation $allocation, array $data): JsonResponse;

    public function resetAllocation(Allocation $allocation): JsonResponse;
}
