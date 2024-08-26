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

Route::get('/{slug}/delegates/sign-up', [ExhibitionController::class, 'delegates_sign_up'])->name('delegates.sign-up');

Route::post('/delegates/register', [ExhibitionController::class, 'register_delegates'])->name('delegates.register');

Route::get('/{slug}/sign-up', [ExhibitionController::class, 'sign_up'])->name('sign.up.for.conference.and.exhibition');

Route::post('/exhibition/register', [ExhibitionController::class, 'register'])->name('exhibition.register');