<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {

    Route::post('register', RegisterController::class)->name('auth.register');

    Route::post('login', LoginController::class)->name('auth.login');

});

Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [TaskController::class, 'getUserTasks'])->name('userTasks');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::put('{id}', [TaskController::class, 'update'])->name('update');
        Route::delete('{id}', [TaskController::class, 'destroy'])->name('destroy');
    });

    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('{id}', [TaskController::class, 'show'])->name('show');
});

