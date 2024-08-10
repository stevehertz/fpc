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

Route::get('/who-we-are', [PagesController::class, 'who_we_are'])->name('who.we.are');

Route::get('/services', [PagesController::class, 'services'])->name('our.services');

Route::get('/blogs', [PagesController::class, 'blog'])->name('blogs');

Route::get('/{slug}/details', [PagesController::class, 'blogDetails'])->name('blog.details');

Route::get('/events', [PagesController::class, 'events'])->name('events');

Route::get('/faqs', [PagesController::class, 'faqs'])->name('faqs');

Route::get('/contact', [PagesController::class, 'contact'])->name('contact.us');

Route::get('/become/member', [PagesController::class, 'becomeMember'])->name('become.member');

Route::get('/terms-and-conditions', [PagesController::class, 'terms_and_conditions'])->name('terms.and.conditions');