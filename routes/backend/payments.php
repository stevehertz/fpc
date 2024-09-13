<?php

use App\Http\Controllers\Backend\PaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('backend/payments/')->name('backend.payments.')->group(function(){

    Route::get('/', [PaymentController::class, 'index'])->name('index');
    
});