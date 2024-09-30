<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgraController;
use App\Http\Controllers\Backend\QrCodeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TermsAndConditionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/welcome', function(){
    return redirect()->route('login');
});

Route::get('/send-qr-code', [QrCodeController::class, 'generateAndSendQrCode']);

Route::get('/agra', [AgraController::class, 'index'])->name('agra');
Route::post('/agra/store', [AgraController::class, 'store'])->name('agra.store');
Route::get('/agra/export', [AgraController::class, 'export'])->name('agra.export');


Route::prefix('terms/conditions')->name('terms.conditions.')->group(function(){
    Route::get('/index', [TermsAndConditionController::class, 'index'])->name('index');
    Route::get('/create', [TermsAndConditionController::class, 'create'])->name('create');
    Route::post('/store', [TermsAndConditionController::class, 'store'])->name('store');
    Route::get('/{id}/show', [TermsAndConditionController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [TermsAndConditionController::class, 'edit'])->name('edit');
    Route::put('/{termsAndCondition}/update', [TermsAndConditionController::class, 'update'])->name('update');
    Route::delete('/{termsAndCondition}/delete', [TermsAndConditionController::class, 'destroy'])->name('delete');
});