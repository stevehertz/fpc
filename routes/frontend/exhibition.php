<?php

use App\Http\Controllers\Frontend\ExhibitionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/sign-up', [ExhibitionController::class, 'sign_up'])->name('sign.up.for.conference.and.exhibition');