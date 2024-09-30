<?php

use App\Http\Controllers\Backend\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('backend/users')->name('backend.users.')->group(function(){

    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::get('/create', [UsersController::class, 'create'])->name('create');
    Route::post('/store', [UsersController::class, 'store'])->name('store');
    Route::get('/{id}/show', [UsersController::class, 'show'])->name('show');
    Route::delete('/{user}/delete', [UsersController::class, 'delete'])->name('delete');
    
});