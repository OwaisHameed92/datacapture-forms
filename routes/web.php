<?php

use App\Http\Controllers\AdminKycController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\KycDocumentController;
use Illuminate\Support\Facades\Route;

// Public KYC submission form
Route::get('/', [KycController::class, 'create'])->name('kyc.form');

Route::post('/kyc', [KycController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('kyc.store');

Route::get('/kyc/thank-you/{customer}', [KycController::class, 'thankyou'])
    ->name('kyc.thankyou');

// Public privacy notice (referenced by the KYC consent declaration).
Route::view('/privacy', 'privacy')->name('privacy');

// After login, send admins straight to the KYC customer list
Route::get('/dashboard', function () {
    return redirect()->route('admin.kyc.customers.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin-only routes for viewing/downloading KYC docs and erasing customers.
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/customers', [AdminKycController::class, 'index'])
        ->name('admin.kyc.customers.index');

    Route::get('/admin/customers/{customer}', [AdminKycController::class, 'show'])
        ->name('admin.kyc.customers.show');

    Route::get('/admin/customers/{customer}/documents/{document}/download', [KycDocumentController::class, 'download'])
        ->name('admin.kyc.documents.download');

    Route::delete('/admin/customers/{customer}', [KycDocumentController::class, 'destroyCustomer'])
        ->name('admin.kyc.customers.destroy');
});

require __DIR__.'/auth.php';
