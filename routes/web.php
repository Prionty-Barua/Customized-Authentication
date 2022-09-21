<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomizedAuthController;
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
Route::get('/login',[CustomizedAuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::get('/registration',[CustomizedAuthController::class,'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user',[CustomizedAuthController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CustomizedAuthController::class,'loginUser'])->name('login-user');
Route::get('/dashboard',[CustomizedAuthController::class,'dashboard']);
Route::get('/logout',[CustomizedAuthController::class,'logout']);
