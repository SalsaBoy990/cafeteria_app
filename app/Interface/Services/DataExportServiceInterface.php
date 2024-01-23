<?php

namespace App\Interface\Services;

interface DataExportServiceInterface
{
    public function exportAllocationsToCSV(): string;
}
