<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::resource('tasks', TaskController::class);
Route::resource('categories', CategoryController::class);
Route::get('/tasks/toggle/{id}', [TaskController::class, 'toggle']);

Route::get('/dashboard', function () {
    return view('dashboard', [
        'total' => \App\Models\Task::count(),
        'done' => \App\Models\Task::where('status','done')->count()
    ]);
});