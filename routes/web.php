<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController ;
use \App\Http\Controllers\BreakfastController ;
use \App\Http\Controllers\VoteController;
use \App\Http\Controllers\UserController ;
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

Route::get('/login', [AuthController::class , 'getLoginPage'] )->name('login')->middleware('guest');
Route::post('/login',[AuthController::class , 'getAuthData'])->name('post-login')->middleware('guest');
Route::get('/logout' , [AuthController::class , 'logout']) ->name('logout') ->middleware('auth');
Route::get('' , [BreakfastController::class , 'show']) ->name('dashboard')->middleware('auth');
Route::get('/breakfast/create' , [BreakfastController::class , 'create'])->name('breakfast.create');
Route::post('brekfast/save' ,  [BreakfastController::class , 'save'])->name('breakfast.save') ;
Route::delete('breakfast/delete/{id}' , [BreakfastController::class , 'destroy']) ->name('breakfast.delete');



Route::resource('breakfsatvotes.vote', VoteController::class);
Route::resource('users', UserController::class ) ;




