<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;
use  App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/offline', function () {
    return view('offline');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [UserController::class, 'index'])->name('home');


Route::middleware(['is_admin'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/status/{task_id}', [TaskController::class, 'status'])->name('tasks.status');
    Route::resource('user', UserController::class);
    Route::get('/user-list', [TaskController::class, 'userList'])->name('user.list');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UserController::class, 'taskList'])->name('home');
    Route::get('/follow-up/{task_id}', [UserController::class, 'followCreate'])->name('follow.create');
    Route::post('/follow-save', [UserController::class, 'followStore'])->name('follow.store');
});
