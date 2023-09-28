<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'v1'
], function () {

    Route::apiResources([
        'task_list' => TaskListController::class,
        'task' => TaskController::class
    ]);

    Route::post('/task_list/completed', [TaskListController::class, 'completed'])->name('tasklist.completed');
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::put('task/close/{id}', [TaskController::class, 'close'])->name('tasks.close');
    Route::put('list/close/{id}', [TaskController::class, 'taskByList'])->name('tasks.list');
});

Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('/register',[UserController::class, 'store'])->name('users.store');
    Route::post('/login',[UserController::class, 'login'])->name('users.login');
});



