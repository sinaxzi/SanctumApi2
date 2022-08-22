<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login',[AuthController::class,'login'])->name('login');;


Route::post('/register',[AuthController::class,'register']);



Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum')->name('logout');

Route::get('/users',[UserController::class,'index'])->middleware('auth:sanctum');

Route::get('/users/{id}',[UserController::class,'show'])->middleware('auth:sanctum');

