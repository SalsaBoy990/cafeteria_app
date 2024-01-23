<?php

namespace App\Services;

use App\Interface\Services\DataExportServiceInterface;
use App\Models\Allocation;

class DataExportService implements DataExportServiceInterface
{
    /**
     * Export all allocations to CSV
     *
     * @return string
     */
    public function exportAllocationsToCSV(): string
    {
        $allocations = Allocation::all();
        $separator = ';';
        $columnNames = ['ID', 'DATE', 'POCKET_1', 'POCKET_2', 'POCKET_3'];
        $stream = implode($separator, $columnNames) . PHP_EOL;

        foreach ($allocations as $allocation) {
            $record = [$allocation->id, $allocation->date, $allocation->pocket1, $allocation->pocket2, $allocation->pocket3];
            $stream .= implode($separator, $record) . PHP_EOL;
        }
        return $stream;
    }
}
