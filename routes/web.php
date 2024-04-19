<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users', [\App\Http\Controllers\UsersController::class, 'index'])->name('users.index');

Route::get('/user-edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('user.edit');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::delete('users/{id}', [\App\Http\Controllers\UsersController::class, 'destroy'])->name('users.destroy');


