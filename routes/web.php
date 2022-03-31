<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/tasks', 'tasks')->name('tasks');
    Route::post('/tasks', 'store')->name('store');
    Route::get('/edit-task/{id}', 'taskEdit')->name('task-edit');
    Route::post('/edit-task-prosess/{id}', 'editStore')->name('edit-store');
    Route::post('/delete-task-prosess/{id}', 'deleteTask')->name('delete-task');
});
