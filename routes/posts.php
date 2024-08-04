<?php

use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->name('posts.')->group(function () {

    Route::get('/index', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/upload', [PostController::class, 'upload'])->name('upload');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/{id}/show', [PostController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{post}/update', [PostController::class, 'update'])->name('update');
    Route::delete('/{post}/delete', [PostController::class, 'destroy'])->name('delete');
});
