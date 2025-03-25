<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;

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

Route::get       ('/top' , [TopController::class, 'index'])->name('top.index');
Route::resource  ('tasks', TaskController::class);
Route::resource  ('users', UserController::class);
Route::controller(LoginController::class)->group(function() {
    Route::get ('login', 'create')->name('login.create');
    Route::post('login', 'store' )->name('login.store' );
    Route::delete('logout', 'destroy')->name('login.destroy');
});
Route::get('/runteq', [TopController::class, 'runteq'])->name('top.runteq');https://maps.gstatic.com/tactile/pane/arrow_left_1x.png