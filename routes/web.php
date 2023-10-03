<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
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


Route::get('/', [ProjectController::class,'index'])->name('projects.index');
Route::get('/projects/{id}/tasks', [ProjectController::class,'view'])->name('projects.tasks.index');
Route::get('/tasks', [TaskController::class,'index'])->name('tasks.index');
