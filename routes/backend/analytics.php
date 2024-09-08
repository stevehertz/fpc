<?php

use App\Http\Controllers\Backend\AnalyticsController;
use Illuminate\Support\Facades\Route;


Route::prefix('analytics')->name('analytics.')->group(function(){

    Route::get('/', [AnalyticsController::class, 'index'])->name('index');
});