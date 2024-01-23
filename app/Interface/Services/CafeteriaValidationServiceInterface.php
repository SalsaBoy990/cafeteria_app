<?php

namespace App\Interface\Services;

use App\Http\Requests\Api\AllocationRequest;
use App\Models\Allocation;

interface CafeteriaValidationServiceInterface
{
    public function getAllocationPocketsSum(Allocation $allocation): int;

    public function getRequestPocketsSum(AllocationRequest $request): int;

    public function getAnnualAllocationSum(): int;

    public function getAnnualPocketSum(string $pocketName): int;

    public function hasExceedingCafeteriaLimit(int $sum): int;

    public function hasExceedingPocketLimit(int $pocketSum, string $pocketName): int;

    public function validatePocket(string $pocketName, AllocationRequest $request, Allocation $allocation): array;

    public function validateCafeteriaLimit(AllocationRequest $request, Allocation $allocation): array;
}
