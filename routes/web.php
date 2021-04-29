<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Models\TaskList;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [TaskListController::class, 'index'])->name('dashboard');
    Route::post('list', [TaskListController::class, 'store']);

    Route::post('task', [TaskController::class, 'store']);
    Route::put('task/{task}', [TaskController::class, 'update']);
    Route::put('task/update-status/{task}', [TaskController::class, 'updateStatus']);
    Route::delete('task/{task}', [TaskController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
