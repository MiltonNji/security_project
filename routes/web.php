<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\UserController;


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

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/chart', [HouseController::class, 'generateChart'])->name('generateChart');

Route::get('/random', [HouseController::class, 'randomPage'])->name('random-page');


Route::get('/form', [UserController::class, 'showForm'])->name('form');
Route::post('/submit-form', [UserController::class, 'submitForm'])->name('submit.form');
Route::get('/success', [UserController::class, 'success'])->name('success');

Route::get('/login', [UserController::class, 'ShowLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HouseController::class, 'index'])->name('home');
});

// Password Reset Routes
Route::get('/forgot-password', [UserController::class, 'showResetForm'])->name('password.request');
Route::post('/reset-password', [UserController::class, 'reset'])->name('password.update');

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/users', [UserController::class, 'showUsers'])->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('users.delete');
});
