<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BreakfastController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

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


Route::get('/login', [AuthController::class, 'show'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('post-login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('', [BreakfastController::class, 'index'])->name('dashboard')->middleware('auth');


Route:: middleware('can:is_admin')->group(
    function () {
        Route::get('/breakfast/create', [BreakfastController::class, 'create'])->name('breakfast.create');
        Route::post('breakfast/save', [BreakfastController::class, 'store'])->name('breakfast.save');
        Route::delete('breakfast/delete/{breakfast}', [BreakfastController::class, 'destroy'])->name('breakfast.delete');
        Route::get('breakfast/update/{breakfast}', [BreakfastController::class, 'edit'])->name('breakfast.update');
        Route::put('breakfast/update/{breakfast}/edit', [BreakfastController::class, 'update'])->name('breakfast.edit');

        Route::resource('users', UserController::class);
    }
);


Route::resource('breakfsatvotes.vote', RateController::class)->middleware('auth');

Route::get('standings', [UserController::class, 'standings'])->name('standings')->middleware('auth');

