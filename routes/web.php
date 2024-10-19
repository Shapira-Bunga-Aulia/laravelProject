<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

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
    Route::patch('/edit/rombel/{id}', [StudentController::class, 'updateRombel'])->name('update.rombel');
});

Route::get('/user', [UserController::class, 'index'])->name
('user.index');

Route::prefix('/user')->name('user.')->group(function() {
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy'); 
});
