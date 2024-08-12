<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/tasks', AdminTaskController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('tasks/load-more', [TaskController::class, 'loadMore'])->name('tasks.loadMore');

});