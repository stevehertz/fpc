<?php

use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\EventController;
use Illuminate\Support\Facades\Route;

Route::prefix('backend')->name('backend.')->group(function(){
    Route::prefix('events')->name('events.')->group(function(){
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/store', [EventController::class, 'store'])->name('store');
        Route::get('/{id}/show', [EventController::class, 'show'])->name('show');
        Route::get('/{id}/view', [EventController::class, 'view'])->name('view');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('/{event}/update', [EventController::class, 'update'])->name('update');
        Route::delete('/{event}/delete', [EventController::class, 'destroy'])->name('delete');
    });

    Route::get('/', function(){
        return redirect()->route('backend.events.index');
    })->name('index');

    Route::prefix('attendance')->name('attendance.')->group(function(){
        Route::get('/', [AttendanceController::class, 'index'])->name('index');
        Route::get('/{attendance_id}/confirm', [AttendanceController::class, 'confirmAttendance'])->name('confirm');
        Route::post('/{attendance}/confirm/exhibitor/attendance', [AttendanceController::class, 'confirmExhibitors'])->name('confirm.exhibitor.attendance');
        Route::post('/{attendance}/cancel/attendance', [AttendanceController::class, 'cancelAttendance'])->name('cancel.attendance');
    });
});