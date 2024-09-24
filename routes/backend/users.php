<?php

use App\Http\Controllers\Backend\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('backend/users')->name('backend.users.')->group(function(){

    Route::get('/', [UsersController::class, 'index'])->name('index');

});