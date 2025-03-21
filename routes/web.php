<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\WoolBatchController;
use App\Http\Controllers\ProcessingUnitController;
use App\Http\Controllers\BatchProcessController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Farm routes
    Route::resource('farms', FarmController::class);
    Route::post('/farms/{farm}/approve', [FarmController::class, 'approve'])->name('farms.approve');
    Route::post('/farms/{farm}/reject', [FarmController::class, 'reject'])->name('farms.reject');

    // Wool Batch routes
    Route::resource('wool-batches', WoolBatchController::class);
    Route::get('/wool-batches/{woolBatch}/track', [WoolBatchController::class, 'track'])->name('wool-batches.track');
    Route::get('/wool-batches/{woolBatch}/qr-code', [WoolBatchController::class, 'generateQRCode'])->name('wool-batches.qr-code');

    // Processing Unit routes
    Route::resource('processing-units', ProcessingUnitController::class);

    // Batch Process routes
    Route::resource('batch-processes', BatchProcessController::class);
    Route::post('/batch-processes/{batchProcess}/complete', [BatchProcessController::class, 'complete'])->name('batch-processes.complete');

    // Distributor routes
    Route::resource('distributors', DistributorController::class);

    // Shipment routes
    Route::resource('shipments', ShipmentController::class);
    Route::post('/shipments/{shipment}/update-status', [ShipmentController::class, 'updateStatus'])->name('shipments.update-status');
    Route::get('/shipments/{shipment}/track', [ShipmentController::class, 'track'])->name('shipments.track');
});

require __DIR__.'/auth.php';