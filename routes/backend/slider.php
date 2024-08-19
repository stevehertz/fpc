<?php

use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/sliders')->name('sliders.')->group(function(){
    Route::get('/', [SliderController::class, 'index'])->name('index');
    Route::get('/create', [SliderController::class, 'create'])->name('create');
    Route::post('/store', [SliderController::class, 'store'])->name('store');
    Route::post('/upload', [SliderController::class, 'upload'])->name('upload');
    Route::get('/{id}/show', [SliderController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [SliderController::class, 'edit'])->name('edit');
    Route::put('/{slider}/update', [SliderController::class, 'update'])->name('update');
    Route::delete('/{slider}/delete', [SliderController::class, 'destroy'])->name('delete');
});