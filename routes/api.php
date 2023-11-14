<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\UserController;

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
    Route::put('task/close/{id}', [TaskController::class, 'closeTask'])->name('task.close');
    Route::get('task/bylist/{id}', [TaskController::class, 'tasksByList'])->name('task.bylist');
    Route::get('/user', [UserController::class, 'show'])->name('user.show');
});

Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('/register',[UserController::class, 'store'])->name('users.store');
    Route::post('/login',[UserController::class, 'login'])->name('users.login');
    Route::get('/', function(){
        return response()->json('Welcome api tasks');
    });
});



