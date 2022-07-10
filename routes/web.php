<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController ;
use \App\Http\Controllers\DashboardController ;
use \App\Http\Controllers\VoteController;

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
Route::get('' , [DashboardController::class , 'dashboard']) ->name('dashboard')->middleware('auth');
Route::get('/logout' , [AuthController::class , 'logout']) ->name('logout') ->middleware('auth');
//Route::resource('vote/{user_id}/{breakfast_id}' , VoteController::class );
////Route::post('vote/{user_id}/{breakfast_id}' , [VoteController::class , 'saveRate'])->name('save.vote');

Route::resource('breakfsatvotes.users', VoteController::class);

