<?php

use App\Http\Controllers\TasksController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('todo', [TasksController::class, 'index'])
    ->name('todo.index')
    ->middleware(['auth:sanctum', 'verified']);

Route::post('todo', [TasksController::class, 'store'])
    ->name('todo.store')
    ->middleware(['auth:sanctum', 'verified']);

Route::put('todo/{task}', [TasksController::class, 'update'])
    ->name('todo.update')
    ->middleware(['auth:sanctum', 'verified']);
