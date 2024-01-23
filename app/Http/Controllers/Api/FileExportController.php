<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interface\Services\DataExportServiceInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileExportController extends Controller
{
    /**
     * @var DataExportServiceInterface
     */
    private DataExportServiceInterface $dataExportService;


    public function __construct(DataExportServiceInterface $dataExportService)
    {
        $this->dataExportService = $dataExportService;
    }


    /**
     * Display a listing of the resource.
     */
    public function download(): StreamedResponse
    {
        $currentDate = (new \DateTime())->format('Y-m-d');
        $exportFilename = $currentDate . '-test.csv';

        return response()->streamDownload(function () {
            echo $this->dataExportService->exportAllocationsToCSV();
        }, $exportFilename, [
            'Content-Type' => 'text/csv',
            'Filename' => $exportFilename
        ]);
    }

}
