<?php

use App\Http\Controllers\Api\AllocationController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\FileExportController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authenticated API routes
Route::group(['prefix' => 'v1',  /*'middleware' => ['auth:sanctum'] */],
    function () {

        Route::post('logout', [LoginController::class, 'logout'])->name('user.logout');

        Route::get('user', function (Request $request) {
            return $request->user();
        })->name('user.me');

        Route::get('article', [ArticleController::class, 'index']);
        Route::get('article/{article}', [ArticleController::class, 'show']);
        Route::post('article', [ArticleController::class, 'store']);
        Route::put('article/{article}', [ArticleController::class, 'update']);
        Route::delete('article/{article}', [ArticleController::class, 'delete']);

        /* Cafeteria allocations */
        Route::get('allocation', [AllocationController::class, 'index'])->name('allocation.all');

        /* CSV export download */
        Route::get('allocation/download_csv', [FileExportController::class, 'download'])->name('allocation.download');
        Route::get('allocation/limits', [AllocationController::class, 'getAllocationLimits'])->name('allocation.limits');
        Route::get('allocation/sums', [AllocationController::class, 'getAllocationSums'])->name('allocation.sums');

        Route::get('allocation/{allocation}', [AllocationController::class, 'show'])->name('allocation.get');
        Route::put('allocation/{allocation}', [AllocationController::class, 'update'])->name('allocation.update');
        Route::put('allocation/reset/{allocation}', [AllocationController::class, 'reset'])->name('allocation.reset');
        /* Cafeteria allocations END */


    }
);
