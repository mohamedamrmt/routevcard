<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\profileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[authController::class,'register']);
Route::post('/registerrequest',[authController::class,'registerRequest']);
Route::get('get/{username}',[profileController::class,'profile']);
Route::get('/login',[authController::class,'login'])->name('login')->middleware('guest');
Route::post('/loginrequest',[authController::class,'loginRequest']);
Route::get('/logout',[authController::class,'logout']);


Route::get('/profile',[profileController::class,'index'])->middleware('auth');
Route::get('/index',[profileController::class,'my_profile'])->middleware('auth');
Route::post('/store',[profileController::class,'store'])->middleware('auth');


