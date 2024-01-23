<?php

namespace App\Services;

use App\Http\Requests\Api\AllocationRequest;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Interface\Entities\AllocationInterface;
use App\Interface\Services\CafeteriaValidationServiceInterface;
use App\Models\Allocation;

class CafeteriaValidationService implements CafeteriaValidationServiceInterface
{
    use ApiResponseTrait;

    /**
     * Gets the sum of allocations
     *
     * @return int
     */
    public function getAnnualAllocationSum(): int
    {
        $result = Allocation::selectRaw('SUM(pocket1) as pocket1, SUM(pocket2) as pocket2, SUM(pocket3) as pocket3')->first();
        return intval($result->pocket1) + intval($result->pocket2) + intval($result->pocket3);
    }


    /**
     * Gets the current annual sums of all cafeteria, and per pockets
     * @return array
     */
    public function getAllocationSums(): array
    {
        $result = Allocation::selectRaw('SUM(pocket1) as pocket1, SUM(pocket2) as pocket2, SUM(pocket3) as pocket3')->first();
        return [
            'cafeteriaSum' => intval($result->pocket1) + intval($result->pocket2) + intval($result->pocket3),
            'pocketOneSum' => intval($result->pocket1),
            'pocketTwoSum' => intval($result->pocket2),
            'pocketThreeSum' => intval($result->pocket3),
        ];
    }


    /**
     * Gets the allocation limits
     *
     * @return array
     */
    public function getAllocationLimits(): array
    {
        return [
            'cafeteriaLimit' => AllocationInterface::CAFETERIA_MAX_LIMIT,
            'pocketLimit' => AllocationInterface::POCKET_MAX_LIMIT,
        ];
    }


    /**
     * Gets the sum of one allocation pocket
     *
     * @param string $pocketName
     * @return int
     */
    public function getAnnualPocketSum(string $pocketName): int
    {
        return Allocation::sum($pocketName);
    }


    /**
     * Checks if cafeteria max limit is exceeded
     *
     * @param int $sum
     * @return int
     */
    public function hasExceedingCafeteriaLimit(int $sum): int
    {
        if ($sum <= AllocationInterface::CAFETERIA_MAX_LIMIT) {
            return 0;
        }
        return $sum - AllocationInterface::CAFETERIA_MAX_LIMIT;
    }


    /**
     * Checks if a pocket max limit is exceeded
     *
     * @param int $pocketSum
     * @param string $pocketName
     * @return int
     */
    public function hasExceedingPocketLimit(int $pocketSum, string $pocketName): int
    {
        if ($pocketSum <= AllocationInterface::POCKET_MAX_LIMIT) {
            return 0;
        }
        return $pocketSum - AllocationInterface::POCKET_MAX_LIMIT;
    }


    /**
     * Get the current sums of the pockets
     * @param Allocation $allocation
     * @return int
     */
    public function getAllocationPocketsSum(Allocation $allocation): int
    {
        return $allocation->pocket1 + $allocation->pocket2 + $allocation->pocket3;
    }


    /**
     * @param AllocationRequest $request
     * @return int
     */
    public function getRequestPocketsSum(AllocationRequest $request): int
    {
        return $request->get('pocket1') + $request->get('pocket2') + $request->get('pocket3');
    }


    /**
     * @param string $pocketName
     * @param AllocationRequest $request
     * @param Allocation $allocation
     * @return array|string[]
     */
    public function validatePocket(string $pocketName, AllocationRequest $request, Allocation $allocation): array
    {
        // Pocket max limit validation
        $pocketSum = $this->getAnnualPocketSum($pocketName) + $request->get($pocketName) - $allocation->pocket1;
        $pocketExceedsAmount = $this->hasExceedingPocketLimit($pocketSum, $pocketName);
        if ($pocketExceedsAmount > 0) {
            return [$pocketName => 'Pocket limit exceeded by ' . $pocketExceedsAmount . ' Ft'];
        }
        return [];
    }


    /**
     * @param AllocationRequest $request
     * @param Allocation $allocation
     * @return array|string[]
     */
    public function validateCafeteriaLimit(AllocationRequest $request, Allocation $allocation): array
    {
        // Cafeteria max limit validation
        $allocationSum = $this->getAnnualAllocationSum() +
            $this->getRequestPocketsSum($request) - $this->getAllocationPocketsSum($allocation);

        $allocationExceedsAmount = $this->hasExceedingCafeteriaLimit($allocationSum);
        if ($allocationExceedsAmount > 0) {
            return ['cafeteriaLimitExceeded' => 'Annual cafeteria limit exceeded by ' . $allocationExceedsAmount . ' Ft'];
        }
        return [];
    }
}
