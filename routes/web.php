<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('home');
});

Route::prefix('/student')->name('student.')->group(function() {
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    Route::get('/', [StudentController::class, 'index'])->name('home');
    Route::get('/{id}', [StudentController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [StudentController::class, 'update'])->name('update');
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('delete');
});
