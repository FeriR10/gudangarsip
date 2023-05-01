<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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

Route::get('/',[AuthController::class, 'login'])->name('login');
Route::get('/logout',[AuthController::class, 'logout']);
Route::get('/register',[AuthController::class, 'register']);
Route::post('/postregister', [AuthController::class, 'postregister']);
Route::post('/postlogin',[AuthController::class, 'postlogin']);


Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboardAdmin',[AdminController::class, 'dashboardAdmin']);
    Route::get('/dashboardUser',[UserController::class, 'dashboardUser']);
});
