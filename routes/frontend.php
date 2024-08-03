<?php

use App\Http\Controllers\Frontend\PagesController;
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

Route::get('/', [PagesController::class, 'index'])->name('home');

Route::get('/about', [PagesController::class, 'about'])->name('about.us');

Route::get('/services', [PagesController::class, 'services'])->name('our.services');